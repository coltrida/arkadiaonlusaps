<?php

namespace App\Livewire\Statistiche;

use App\Services\ClientService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class FormPresenzeClienti extends Component
{
    public $client_id;
    public $annoOggi;
    public $annoInizio;
    public $meseSelezionato;
    public $annoSelezionato;
    public $isLoading = false;

    public function visualizza()
    {
        $this->isLoading = true;

        $request = new Request();
        $request->client_id = $this->client_id;
        $request->meseSelezionato = $this->meseSelezionato;
        $request->annoSelezionato = $this->annoSelezionato;
        $this->dispatch('visualizzaStatistichePresenzeClienti', requestData: $request);
    }

    #[On('datiCaricati')]
    public function datiCaricati()
    {
        $this->isLoading = false; // Nascondi lo spinner
    }

    public function mount()
    {
        $this->meseSelezionato = Carbon::now()->month;
        $this->annoOggi = $this->annoSelezionato = Carbon::now()->year;
        $this->annoInizio = 2020;
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.statistiche.form-presenze-clienti', [
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
