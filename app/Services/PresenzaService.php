<?php

namespace App\Services;

use App\Models\Presenze;
use App\Models\User;
use Carbon\Carbon;

class PresenzaService
{
    public function inserisciPresenza($request)
    {
        Presenze::create([
            'user_id' => auth()->id(),
            'giorno' => $request->giorno,
            'ore' => $request->ore,
            'mese' => Carbon::make($request->giorno)->month,
            'anno' => Carbon::make($request->giorno)->year,
            'settimana' => Carbon::make($request->giorno)->week,
        ]);
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
