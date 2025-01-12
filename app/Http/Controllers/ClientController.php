<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function listaClienti()
    {
        return view('pages.client.listaClienti', [
            'title' => 'Lista Clienti'
        ]);
    }

    public function associaAttivitaClienti()
    {
        return view('pages.client.associaAttivitaClienti', [
            'title' => 'Associa Attività - Cliente'
        ]);
    }

    public function presenzeAttivita()
    {
        return view('pages.client.presenzeAttivita', [
            'title' => 'Presenze Attività'
        ]);
    }
}
