<?php

namespace App\Livewire\Statistiche;

use App\Services\ClientService;
use App\Services\StatisticheService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class ChilometriClienti extends Component
{

    public $client_id;
    public $annoOggi;
    public $annoInizio = 2020;
    public $annoSelezionato;
    public $visualizzaStatistiche;
    public $mesi = [];
    public $trips;

    public function mount()
    {
        $this->annoOggi = $this->annoSelezionato = Carbon::now()->year;
    }

    public function visualizza(StatisticheService $statisticheService)
    {
        $this->visualizzaStatistiche = true;

        $request = new Request();
        $request->client_id = $this->client_id;
        $request->anno = $this->annoSelezionato;
        $request->mesi = $this->mesi;
        $this->trips = $statisticheService->chilometriRagazzi($request);
    }

    public function elimina($id)
    {

    }

    public function render(ClientService $clientService)
    {
        return view('livewire.statistiche.chilometri-clienti', [
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
