<?php

namespace App\Livewire\Trip;

use App\Services\CarService;
use App\Services\ClientService;
use App\Services\LogService;
use App\Services\TripService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;

class FormInserisciChilometri extends Component
{
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

        $res = $tripService->inserisciViaggio($request);

        if ($res[1] == 'success'){
            $tipo = 'inserimento viaggio e km';
            $data = 'Inserito viaggio per il giorno '.$this->giorno.' per la macchina con id: '. $this->car_id;
            $logService->scriviLog(auth()->id(), $tipo, $data);

            $this->reset('car_id', 'user_id', 'giorno', 'km_iniziali', 'km_finali');
            $this->clients = [];
        }


        $this->dispatch('aggiungiViaggio', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function render(CarService $carService, UserService $userService, ClientService $clientService)
    {
        return view('livewire.trip.form-inserisci-chilometri', [
            'listaVetture' => $carService->listaVetture(),
            'listaOperatori' => $userService->listaOperatori(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
