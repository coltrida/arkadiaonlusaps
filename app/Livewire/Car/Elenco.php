<?php

namespace App\Livewire\Car;

use App\Models\Car;
use App\Services\CarService;
use Illuminate\Http\Request;
use Livewire\Component;

class Elenco extends Component
{

    public $visualizzaListaVetture = true;
    public $name;
    public $vetturaDaModificare;

    public function inserisciOrModifica(CarService $carService)
    {
        $request = new Request();
        $request->merge([
            'name' => $this->name,
        ]);

        if ($this->visualizzaListaVetture){
            $carService->inserisci($request);
        } else {
            $carService->modifica($this->vetturaDaModificare, $request);
        }

        $this->reset('name', 'vetturaDaModificare');
        $this->visualizzaListaVetture = true;
        $this->dispatch('aggiungi');
    }

    public function elimina(CarService $carService, $idCar)
    {
        $carService->elimina($idCar);
    }

    public function modifica(Car $item)
    {
        $this->visualizzaListaVetture = false;
        $this->name = $item->name;
        $this->vetturaDaModificare = $item;
    }

    public function annulla()
    {
        $this->visualizzaListaVetture = true;
        $this->reset('name');
    }

    public function render(CarService $carService)
    {
        return view('livewire.car.elenco', [
            'listaVetture' => $carService->listaVetture()
        ]);
    }
}
