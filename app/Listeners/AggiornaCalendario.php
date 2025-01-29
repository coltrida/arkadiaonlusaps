<?php

namespace App\Listeners;

use App\Events\SalvaAppuntamento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AggiornaCalendario
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SalvaAppuntamento $event): void
    {
        // Logica aggiuntiva per elaborare i dati
        Log::info('Evento ricevuto:'.$event);
    }
}
