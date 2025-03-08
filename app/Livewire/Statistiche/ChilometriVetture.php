<?php

namespace App\Livewire\Statistiche;

use App\Services\CarService;
use App\Services\StatisticheService;
use App\Services\TripService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class ChilometriVetture extends Component
{

    public $visualizzaStatistiche;
    public $trips;


    #[On('visualizzaStatisticheChilometriVetture')]
    public function visualizza(StatisticheService $statisticheService, $requestData)
    {
        $this->visualizzaStatistiche = true;
        $request = Request::createFrom(new Request($requestData));

        $this->trips = $statisticheService->chilometriVetture($request);

        // Notifica il completamento al componente di origine
        $this->dispatch('datiCaricati');
    }

    public function elimina(TripService $tripService, $id)
    {
        $tripService->elimina($id);
        $this->trips = $this->trips->filter(function ($trip) use ($id) {
            return $trip->id != $id;
        });
    }

    public function stampaLista()
    {
        $pdf = Pdf::loadView('livewire.pdf.listaChilometri', ['trips' => $this->trips]);
        $fileName = "listaChilometri.pdf";
        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, $fileName);
    }

    public function render()
    {
        return view('livewire.statistiche.chilometri-vetture');
    }
}
