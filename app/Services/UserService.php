<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function infoUser($id)
    {
        return User::find($id);
    }

    public function listaOperatori()
    {
        return User::where('role', '<>', 1)->latest()->get();
    }

    public function eliminaUser($idUser)
    {
        User::find($idUser)->delete();
    }

    public function modificaUser($user, $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->oresaldo = $request->oresaldo;
        $user->oresettimanali = $request->oresettimanali;
        $user->save();
    }

    public function inserisciUser($request)
    {
        return User::create($request->all());
    }

    public function associaOperatoreOresettimanali($request)
    {
        $user = User::find($request->user_id);
        $user->oresettimanali = $request->oresettimanali;
        $user->save();
    }
}
