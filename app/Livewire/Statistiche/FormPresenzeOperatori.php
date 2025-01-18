<?php

namespace App\Livewire\Statistiche;

use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class FormPresenzeOperatori extends Component
{
    public $settimanaAttuale;
    public $settimane = [];
    public $settimanaSelezionata;
    public $user_id;
    public $annoAttuale;
    public $isLoading = false;

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

    public function visualizza()
    {
        $this->isLoading = true;

        $request = new Request();
        $request->settimana = $this->settimanaSelezionata + 1;
        $request->user_id = $this->user_id;
        $request->anno = $this->annoAttuale;
        $this->dispatch('visualizzaStatistichePresenzeOperatori', requestData: $request);
    }

    #[On('datiCaricati')]
    public function datiCaricati()
    {
        $this->isLoading = false; // Nascondi lo spinner
    }

    public function render(UserService $userService)
    {
        return view('livewire.statistiche.form-presenze-operatori', [
            'listaOperatori' => $userService->listaOperatori()
        ]);
    }
}
