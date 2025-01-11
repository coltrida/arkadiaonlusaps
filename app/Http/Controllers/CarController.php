<?php

namespace App\Http\Controllers;

use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function listaVetture()
    {
        return view('pages.car.listaVetture', [
            'title' => 'Lista Vetture'
        ]);
    }
}
