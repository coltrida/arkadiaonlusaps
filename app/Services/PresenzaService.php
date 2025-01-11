<?php

namespace App\Services;

use App\Models\Presenze;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class PresenzaService
{
    public function inserisciPresenza($request)
    {
        try {
            Presenze::create($request->all());
            return ['Presenza Inserita Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->giorno){
                    return ['Giorno Obbligatorio - inserimento non effettuato', 'error'];
                } elseif (!$request->ore){
                    return ['Ore Obbligatorie - inserimento non effettuato', 'error'];
                }
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function eliminaPresenza($idPresenza)
    {
        $presenza = $presenzaDaInviareALog = Presenze::find($idPresenza);
        $presenza->delete();
        return $presenzaDaInviareALog;
    }

    public function listaPresenzePaginate($idUser)
    {
        return User::with('presenze')->find($idUser)->presenze()->paginate(3);
    }
}
