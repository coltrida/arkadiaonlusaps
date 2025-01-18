<?php

namespace App\Livewire\Statistiche;

use App\Services\ClientService;
use App\Services\StatisticheService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class FormChilometriClienti extends Component
{
    public $client_id;
    public $annoOggi;
    public $annoInizio = 2020;
    public $annoSelezionato;
    public $mesi = [];
    public $isLoading = false;

    public function mount()
    {
        $this->annoOggi = $this->annoSelezionato = Carbon::now()->year;
    }

    public function visualizza(StatisticheService $statisticheService)
    {
        $this->isLoading = true;

        $request = new Request();
        $request->client_id = $this->client_id;
        $request->anno = $this->annoSelezionato;
        $request->mesi = $this->mesi;
        $this->dispatch('visualizzaStatisticheChilometriClienti', requestData: $request);
    }

    #[On('datiCaricati')]
    public function datiCaricati()
    {
        $this->isLoading = false; // Nascondi lo spinner
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.statistiche.form-chilometri-clienti', [
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
