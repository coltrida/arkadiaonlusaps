<?php

namespace App\Livewire\Statistiche;

use App\Services\CarService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class FormChilometriVetture extends Component
{
    public $car_id;
    public $annoOggi;
    public $annoInizio = 2020;
    public $annoSelezionato;
    public $mesi = [];
    public $isLoading = false;


    public function mount()
    {
        $this->annoOggi = $this->annoSelezionato = Carbon::now()->year;
    }

    public function visualizza()
    {
        $this->isLoading = true;

        $request = new Request();
        $request->car_id = $this->car_id;
        $request->anno = $this->annoSelezionato;
        $request->mesi = $this->mesi;
        $this->dispatch('visualizzaStatisticheChilometriVetture', requestData: $request);
    }

    #[On('datiCaricati')]
    public function datiCaricati()
    {
        $this->isLoading = false; // Nascondi lo spinner
    }

    public function render(CarService $carService)
    {
        return view('livewire.statistiche.form-chilometri-vetture', [
            'listaVetture' => $carService->listaVetture()
        ]);
    }
}
