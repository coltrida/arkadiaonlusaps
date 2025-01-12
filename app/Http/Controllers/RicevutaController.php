<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RicevutaController extends Controller
{
    public function ricevute()
    {
        return view('pages.ricevute.listaRicevute', [
            'title' => 'Lista Ricevute'
        ]);
    }
}
