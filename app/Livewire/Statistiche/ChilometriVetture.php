<?php

namespace App\Livewire\Statistiche;

use App\Services\CarService;
use App\Services\StatisticheService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class ChilometriVetture extends Component
{  public $car_id;
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
        $request->car_id = $this->car_id;
        $request->anno = $this->annoSelezionato;
        $request->mesi = $this->mesi;
        $this->trips = $statisticheService->chilometriVetture($request);
    }

    public function elimina($id)
    {

    }



    public function render(CarService $carService)
    {
        return view('livewire.statistiche.chilometri-vetture', [
            'listaVetture' => $carService->listaVetture()
        ]);
    }
}
