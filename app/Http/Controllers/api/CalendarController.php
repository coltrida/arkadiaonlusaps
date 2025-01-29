<?php

namespace App\Http\Controllers\api;

use App\Events\SalvaAppuntamento;
use App\Http\Controllers\Controller;
use App\Models\Appuntamento;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function getAppuntamenti()
    {
        return Appuntamento::all();
    }

    public function salvaAppuntamento(Request $request)
    {
        $appuntamento = Appuntamento::create([
            'startDate' => $request->startDate,
            'titolo' => $request->titolo,
            'user_id' => 1,
        ]);

        if ($appuntamento){
         //   SalvaAppuntamento::dispatch($appuntamento);
            event(new SalvaAppuntamento($appuntamento));
            return 'salvataggio appuntamento effettuato correttamente per il giorno '.$appuntamento->startDate;
        }

        return 'Errore nel salvataggio appuntamento. Tipo di errore: '.$appuntamento;
    }
}
