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
}
