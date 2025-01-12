<?php

namespace App\Livewire\Car;

use App\Models\Car;
use App\Services\CarService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;

class Elenco extends Component
{

    public $visualizzaListaVetture = true;
    public $name;
    public $vetturaDaModificare;

    public function inserisciOrModifica(CarService $carService, LogService $logService)
    {
        $request = new Request();
        $request->merge([
            'name' => $this->name,
        ]);

        if ($this->visualizzaListaVetture){
            $carService->inserisci($request);
            $tipo = 'inserimento vettura';
            $data = 'Vettura: '.$this->name.' inserita';
            $logService->scriviLog(auth()->id(), $tipo, $data);
        } else {
            $carService->modifica($this->vetturaDaModificare, $request);
            $tipo = 'modifica vettura';
            $data = 'Vettura: '.$this->name.' modificata';
            $logService->scriviLog(auth()->id(), $tipo, $data);
        }

        $this->reset('name', 'vetturaDaModificare');
        $this->visualizzaListaVetture = true;
        $this->dispatch('aggiungi');
    }

    public function elimina(CarService $carService, LogService $logService, $idCar)
    {
        $carService->elimina($idCar);

        $tipo = 'eliminazione vettura';
        $data = 'Vettura con id = '.$idCar.' eliminata';
        $logService->scriviLog(auth()->id(), $tipo, $data);
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
