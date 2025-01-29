<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticheController extends Controller
{
    public function presenzeClienti()
    {
        return view('pages.statistiche.presenzeClienti', [
            'title' => 'Statistiche Presenze Clienti'
        ]);
    }

    public function presenzeOperatori()
    {
        return view('pages.statistiche.presenzeOperatori', [
            'title' => 'Statistiche Presenze Operatori'
        ]);
    }

    public function chilometriVetture()
    {
        return view('pages.statistiche.chilometriVetture', [
            'title' => 'Statistiche Chilometri Vetture'
        ]);
    }

    public function chilometriClienti()
    {
        return view('pages.statistiche.chilometriClienti', [
            'title' => 'Statistiche Chilometri Clienti'
        ]);
    }

    public function stampaPresenzeClienti(Request $request)
    {
        $ragazzoConPresenzeAttivita = json_decode($request->input('ragazzoConPresenzeAttivita'), true);
      //  dd($ragazzoConPresenzeAttivita);
        $anno = $request->anno;
        $mese = $request->mese;
        $saldoOriginale = $request->saldoOriginale;
        $nuovoSaldo = $request->nuovoSaldo;
        $causaleMod = $request->causaleMod;
        $importoMod = $request->importoMod;
        $dataMod = $request->dataMod;

        return view('pages.statistiche.stampaPresenzeClienti',
            compact('ragazzoConPresenzeAttivita', 'anno', 'mese', 'saldoOriginale', 'nuovoSaldo',
                'causaleMod', 'importoMod', 'dataMod'));

    }
}
