<?php

namespace App\Livewire\Statistiche;

use App\Services\StatisticheService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class PresenzeOperatori extends Component
{
    public $visualizzaStatistiche = false;
    public $settimanaAttuale;
    public $settimane = [];
    public $settimanaSelezionata;
    public $user_id;
    public $annoAttuale;
    public $presenze;
    public $saldoOre;

    public function mount()
    {
        $this->settimanaAttuale = Carbon::now()->week;
        $this->settimanaSelezionata = $this->settimanaAttuale - 1;
        $settimanaFinale = Carbon::now()->weekOfYear;
        $this->annoAttuale = Carbon::now()->year;
        for ($settimana = 1; $settimana <= $settimanaFinale; $settimana++){
            $dataInizioSettimana = Carbon::now()->setISODate($this->annoAttuale, $settimana)->startOfWeek()->format('d/m/Y');
            $item = 'settimana: '.$settimana.' - dal: '.$dataInizioSettimana;
            $this->settimane[] = $item;
        }
    }

    public function visualizza(StatisticheService $statisticheService, UserService $userService)
    {
        $this->visualizzaStatistiche = true;
        $this->saldoOre = $userService->infoUser($this->user_id)->oresaldo;

        $request = new Request();
        $request->settimana = $this->settimanaSelezionata + 1;
        $request->user_id = $this->user_id;
        $request->anno = $this->annoAttuale;
        $this->presenze = $statisticheService->presenzeOperatore($request);
    }


    public function render(UserService $userService)
    {
        return view('livewire.statistiche.presenze-operatori', [
            'listaOperatori' => $userService->listaOperatori()
        ]);
    }
}
