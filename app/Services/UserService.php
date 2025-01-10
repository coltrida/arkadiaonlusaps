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
        return User::where('role', '<>', 1)->orderBy('name')->get();
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
        User::create([
            'name' => $request->name,
            'role' => 0,
            'email' => $request->email,
            'oresettimanali' => $request->oresettimanali,
            'oresaldo' => 0,
            'password' => Hash::make($request->password)
        ]);
    }

    public function associaOperatoreOresettimanali($request)
    {
        $user = User::find($request->user_id);
        $user->oresettimanali = $request->oresettimanali;
        $user->save();
    }
}
