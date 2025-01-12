<?php

namespace App\Services;

use App\Models\Log;

class LogService
{
    public function scriviLog($idUser, $tipo, $data)
    {
        Log::create([
            'user_id' => $idUser,
            'tipo' => $tipo,
            'data' => $data
        ]);
    }

    public function listaLogPaginate()
    {
        return Log::with('user')->latest()->paginate(10);
    }
}
