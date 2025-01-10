<?php

namespace App\Services;


use App\Models\Client;
use App\Models\Presenze;
use App\Models\Trip;

class StatisticheService
{
    public function presenzeRagazzi($request)
    {
        return Client::with([
            'activitiesMensili' => function($m) use ($request) {
            $m->where('mese', $request->meseSelezionato);
        }, 'activitiesOrario' => function($o) use ($request){
            $o->where('mese', $request->meseSelezionato);
        }])->find($request->client_id);
    }

    public function presenzeOperatore($request)
    {
        return Presenze::where([
            ['user_id', $request->user_id],
            ['anno', $request->anno],
            ['settimana',$request->settimana]
        ])->get();
    }

    public function chilometriVetture($request)
    {
        return Trip::with('clients', 'user')
            ->where([
                ['car_id', $request->car_id],
                ['anno', $request->anno],
            ])
            ->whereIn('mese', $request->mesi)
            ->orderBy('giorno')
            ->get();
    }

    public function chilometriRagazzi($request)
    {
        return Client::with('trips')->find($request->client_id)->trips;
    }
}
