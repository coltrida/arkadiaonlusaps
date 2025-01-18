<?php

namespace App\Livewire\Statistiche;

use App\Services\StatisticheService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class PresenzeOperatori extends Component
{
    public $visualizzaStatistiche = false;

    public $presenze;
    public $saldoOre;


    #[On('visualizzaStatistichePresenzeOperatori')]
    public function visualizza(StatisticheService $statisticheService, UserService $userService, $requestData)
    {
        $this->visualizzaStatistiche = true;
        $request = Request::createFrom(new Request($requestData));

        $this->saldoOre = $userService->infoUser($request->user_id)->oresaldo;
        $this->presenze = $statisticheService->presenzeOperatore($request);

        // Notifica il completamento al componente di origine
        $this->dispatch('datiCaricati');
    }


    public function render()
    {
        return view('livewire.statistiche.presenze-operatori');
    }
}
