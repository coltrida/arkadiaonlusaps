<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Associa;
use App\Models\AttivitaCliente;
use Carbon\Carbon;

class ActivityService
{
    public function listaAttivita()
    {
        return Activity::orderBy('name')->get();
    }

    public function listaAttivitaPaginate()
    {
        return Activity::latest()->paginate(5);
    }

    public function inserisci($request)
    {
        Activity::create([
            'name' => $request->name,
            'tipo' => $request->tipo,
            'cost' => $request->cost,
        ]);
    }

    public function inserisciAssociazioneAttivitaClient($request)
    {
        $activity = Activity::find($request->activity_id);
        $activity->associaclients()->attach($request->clients);
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
        $attivita = Activity::find($request->activity_id);

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
    }

    public function eliminaAttivitaClient($id)
    {
        AttivitaCliente::find($id)->delete();
    }
}
