<?php

namespace App\Http\Controllers;

use App\Services\LogService;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function listaLog(LogService $logService)
    {
        return view('pages.log.listaLog', [
            'title' => 'Lista Log',
            'listaLogPaginate' => $logService->listaLogPaginate()
        ]);
    }
}
