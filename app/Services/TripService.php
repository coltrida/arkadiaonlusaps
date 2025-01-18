<?php

namespace App\Services;

use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class TripService
{
    public function listaTuttiViaggiPaginate()
    {
        return Trip::with('user', 'car')->latest()->paginate(5);
    }

    public function inserisciViaggio($request)
    {
        if ($request->clients == []){
            return ['Inserisci almeno 1 cliente - inserimento non effettuato', 'error'];
        }

        try {
            $trip = Trip::create([
                'kmPercorsi' => $request->kmPercorsi,
                'user_id' => $request->user_id,
                'car_id' => $request->car_id,
                'giorno' => $request->giorno,
                'mese' => $request->giorno ? Carbon::make($request->giorno)->month : null,
                'anno' => $request->giorno ? Carbon::make($request->giorno)->year : null
            ]);
            $trip->clients()->attach($request->clients);
            return ['Viaggio Inserito Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->kmPercorsi){
                    return ['chilometri Obbligatori - inserimento non effettuato', 'error'];
                }elseif (!$request->user_id){
                    return ['Operatore Obbligatorio - inserimento non effettuato', 'error'];
                }elseif (!$request->car_id){
                    return ['Vettura Obbligatoria - inserimento non effettuato', 'error'];
                }elseif (!$request->giorno){
                    return ['Giorno Obbligatorio - inserimento non effettuato', 'error'];
                }
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function elimina($id)
    {
        Trip::find($id)->delete();
    }
}
