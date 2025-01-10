<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listaOperatori(UserService $userService)
    {
        return view('pages.user.listaOperatori', [
            'title' => 'Lista Operatori',
            'listaOperatori' => $userService->listaOperatori()
        ]);
    }
}
