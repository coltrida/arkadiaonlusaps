<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listaOperatori()
    {
        return view('pages.user.listaOperatori', [
            'title' => 'Lista Operatori'
        ]);
    }

    public function presenzeOperatore()
    {
        return view('pages.user.presenzeOperatore', [
            'title' => 'Presenze Operatore'
        ]);
    }
}
