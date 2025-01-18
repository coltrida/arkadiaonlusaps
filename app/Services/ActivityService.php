<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Associa;
use App\Models\AttivitaCliente;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ActivityService
{
    public function activityFromId($id)
    {
        return Activity::find($id);
    }

    public function listaAttivita()
    {
        return Activity::orderBy('name')->get();
    }

    public function listaAttivitaPaginate($testo)
    {
        return Activity::where('name', 'like', '%'.$testo.'%')->latest()->paginate(5);
    }

    public function inserisci($request)
    {
        try {
            Activity::create($request->all());
            return ['Attività Inserita Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->name){
                    return ['Nome Obbligatorio - inserimento non effettuato', 'error'];
                }elseif (!$request->tipo){
                    return ['Tipo Obbligatorio - inserimento non effettuato', 'error'];
                }elseif (!$request->cost){
                    return ['Costo Obbligatorio - inserimento non effettuato', 'error'];
                }
                return ['Attività già presente - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function modifica($activity, Request $request)
    {
        try {
            $activity->name = $request->name;
            $activity->tipo = $request->tipo;
            $activity->cost = $request->cost;
            $activity->save();
            return ['Attività Modificata Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->name){
                    return ['Nome Obbligatorio - inserimento non effettuato', 'error'];
                }elseif (!$request->tipo){
                    return ['Tipo Obbligatorio - inserimento non effettuato', 'error'];
                }elseif (!$request->cost){
                    return ['Costo Obbligatorio - inserimento non effettuato', 'error'];
                }
                return ['Attività già presente - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function elimina($id)
    {
        $client = Activity::find($id);
        $client->name = $client->name.' - cancellato';
        $client->save();
        $client->delete();
    }

    public function listaAssociazioniAttivitaClientPaginate($testoRicerca)
    {
        return Associa::with('client', 'activity')
            ->whereHas('client', function ($c) use ($testoRicerca){
                $c->where('name', 'like', '%'.$testoRicerca.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
    }

    public function inserisciAssociazioneAttivitaClient($request)
    {
        try {
            $activity = Activity::findOrFail($request->activity_id);
            $activity->associaclients()->attach($request->clients);
            return ['Associazione inserita Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->activity_id){
                    return ['Attività non selezionata - inserimento non effettuato', 'error'];
                }elseif (!$request->clients){
                    return ['seleziona clienti - inserimento non effettuato', 'error'];
                }
                return ['associazione già presente - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            if (!$request->activity_id){
                return ['selezione attività obbligatoria - inserimento non effettuato', 'error'];
            }elseif (!$request->clients){
                return ['selezione clienti obbligatoria - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        }
    }

    public function eliminaAssociazioneAttivitaCliente($id)
    {
        Associa::find($id)->delete();
    }

    public function listaIdClientsFromIdActivity($idActivity)
    {
        return Associa::where('activity_id', $idActivity)->get()->pluck('client_id')->toArray();
    }

    public function inserisciAttivitaClient($request)
    {
        if ($request->clients == []){
            return ['seleziona clienti! - inserimento non effettuato', 'error'];
        } elseif (!$request->giorno){
            return ['seleziona giorno! - inserimento non effettuato', 'error'];
        }
        try {
            $attivita = Activity::findOrFail($request->activity_id);
            foreach ($request->clients as $idClient){
                AttivitaCliente::create([
                    'activity_id' => $request->activity_id,
                    'client_id' => $idClient,
                    'quantita' => $request->quantita,
                    'costo' => (float) $request->quantita * (float) $attivita->cost,
                    'giorno' => $request->giorno,
                    'anno' => Carbon::make($request->giorno)->year,
                    'mese' => Carbon::make($request->giorno)->month,
                    'note' => $request->note,
                ]);
            }
            return ['Inserimento presenze eseguita correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->activity_id){
                    return ['Attività non selezionata - inserimento non effettuato', 'error'];
                }
                return ['associazione già presente - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            if (!$request->activity_id){
                return ['selezione attività obbligatoria - inserimento non effettuato', 'error'];
            }elseif (!$request->clients){
                return ['selezione clienti obbligatoria - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        }
    }

    public function eliminaAttivitaClient($id)
    {
        AttivitaCliente::find($id)->delete();
    }
}
