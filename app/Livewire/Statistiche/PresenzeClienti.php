<?php

namespace App\Livewire\Statistiche;

use App\Services\ActivityService;
use App\Services\ClientService;
use App\Services\StatisticheService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class PresenzeClienti extends Component
{
    public $client_id;
    public $annoOggi;
    public $annoInizio;
    public $meseSelezionato;
    public $annoSelezionato;
    public $visualizzaStatistiche = false;
    public $ragazzoConPresenzeAttivita;
    public $totale;

    public function mount()
    {
        $this->meseSelezionato = Carbon::now()->month;
        $this->annoOggi = $this->annoSelezionato = Carbon::now()->year;
        $this->annoInizio = 2020;
    }

    public function visualizza(StatisticheService $statisticheService)
    {
        $this->visualizzaStatistiche = true;

        $request = new Request();
        $request->client_id = $this->client_id;
        $request->meseSelezionato = $this->meseSelezionato;
        $request->annoSelezionato = $this->annoSelezionato;
        $this->ragazzoConPresenzeAttivita = $statisticheService->presenzeRagazzi($request);
        $this->totale = $this->ragazzoConPresenzeAttivita->activitiesMensili->sum('pivot.costo')
            + $this->ragazzoConPresenzeAttivita->activitiesOrario->sum('pivot.costo');
    }

    public function elimina(ActivityService $activityService, StatisticheService $statisticheService, $id)
    {
        $activityService->eliminaAttivitaClient($id);
        $request = new Request();
        $request->client_id = $this->client_id;
        $request->meseSelezionato = $this->meseSelezionato;
        $request->annoSelezionato = $this->annoSelezionato;
        $this->ragazzoConPresenzeAttivita = $statisticheService->presenzeRagazzi($request);
        $this->totale = $this->ragazzoConPresenzeAttivita->activitiesMensili->sum('pivot.costo')
            + $this->ragazzoConPresenzeAttivita->activitiesOrario->sum('pivot.costo');
    }


    public function render(ClientService $clientService)
    {
        return view('livewire.statistiche.presenze-clienti', [
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
