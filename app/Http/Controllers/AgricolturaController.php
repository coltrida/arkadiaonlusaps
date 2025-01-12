<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgricolturaController extends Controller
{
    public function agricoltura()
    {
        return view('pages.agricoltura.agricoltura', [
            'title' => 'Agricoltura'
        ]);
    }
}
