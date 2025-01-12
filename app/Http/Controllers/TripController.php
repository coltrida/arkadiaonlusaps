<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function inserisciChilometri()
    {
        return view('pages.trip.inserisciChilometri', [
            'title' => 'Inserisci Chilometri'
        ]);
    }
}
