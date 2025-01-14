<?php

namespace App\Livewire\Trip;

use App\Services\ActivityService;
use App\Services\CarService;
use App\Services\ClientService;
use App\Services\LogService;
use App\Services\TripService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class InserisciChilometri extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $car_id;
    public $user_id;
    public $km_iniziali;
    public $km_finali;
    public $giorno;
    public $clients = [];

    public function inserisci(TripService $tripService, LogService $logService)
    {
        $request = new Request();
        $request->merge([
            'car_id' => $this->car_id,
            'user_id' => $this->user_id,
            'giorno' => $this->giorno,
            'kmPercorsi' => (int) $this->km_finali - (int) $this->km_iniziali,
            'clients' => $this->clients,
        ]);

        dd($request);

        $res = $tripService->inserisciViaggio($request);
        $tipo = 'inserimento viaggio e km';
        $data = 'Inserito viaggio per il giorno '.$this->giorno.' per la macchina con id: '. $this->car_id;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('car_id', 'user_id', 'giorno', 'km_iniziali', 'km_finali');
        $this->clients = [];

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function elimina(TripService $tripService, LogService $logService, $id)
    {
        $tripService->elimina($id);

        $tipo = 'eliminazione viaggio e km';
        $data = 'eliminato viaggio con id: '.$id;
        $logService->scriviLog(auth()->id(), $tipo, $data);
    }


    public function render(TripService $tripService, CarService $carService, UserService $userService, ClientService $clientService)
    {
        return view('livewire.trip.inserisci-chilometri', [
            'listaTuttiViaggiPaginate' => $tripService->listaTuttiViaggiPaginate(),
            'listaVetture' => $carService->listaVetture(),
            'listaOperatori' => $userService->listaOperatori(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
