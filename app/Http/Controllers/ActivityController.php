<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function listaAttivita()
    {
        return view('pages.activity.listaAttivita', [
            'title' => 'Lista Attività'
        ]);
    }
}
