<?php

namespace App\Services;

use App\Models\Agricoltura;
use App\Models\Client;
use Illuminate\Support\Carbon;

class AgricolturaService
{
    public function presenzeAssenze($request)
    {
        return Client::with(['presenzeAgricoltura' => function($p) use ($request){
            $p->where('anno', $request->anno)->where('mese', $request->mese);
        }, 'assenzeAgricoltura' => function($a) use ($request){
            $a->where('anno', $request->anno)->where('mese', $request->mese);
        }])->find($request->client_id);
    }

    public function inserisciPresenze($request)
    {
        for ($i=1; $i<=31; $i++){
            $nomeChiave = "valoriSelezionati" . $i;
            if ($request->$nomeChiave){
                Agricoltura::create([
                    'user_id' => $request->client_id,
                    'tipo' => $request->$nomeChiave,
                    'mese' => $request->mese,
                    'anno' => $request->anno,
                    'giorno' => Carbon::createFromFormat('d/m/Y', $i.'/'.$request->mese.'/'.$request->anno)->format('d/m/Y'),
                    'settimana' => Carbon::createFromFormat('d/m/Y', $i.'/'.$request->mese.'/'.$request->anno)->week
                ]);
            }
        }
    }

    public function eliminaPresenza($id)
    {
        Agricoltura::find($id)->delete();
    }

    public function clienteConPresenze($request)
    {
        return Client::with(['agricoltura' => function($a) use ($request){
            $a->where('anno', $request->anno)->where('mese', $request->mese);
        }])->find($request->client_id);
    }
}
