<?php

namespace App\Livewire\Statistiche;

use App\Services\ActivityService;
use App\Services\StatisticheService;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class PresenzeClienti extends Component
{
    public $visualizzaStatistiche = false;
    public $ragazzoConPresenzeAttivita;
    public $totale;

    #[On('visualizzaStatistichePresenzeClienti')]
    public function visualizza(StatisticheService $statisticheService, $requestData)
    {
        $request = Request::createFrom(new Request($requestData));
        $this->visualizzaStatistiche = true;

        $this->ragazzoConPresenzeAttivita = $statisticheService->presenzeRagazzi($request);
        $this->totale = $this->ragazzoConPresenzeAttivita->activitiesMensili->sum('pivot.costo')
            + $this->ragazzoConPresenzeAttivita->activitiesOrario->sum('pivot.costo');

        // Notifica il completamento al componente di origine
        $this->dispatch('datiCaricati');
    }

    public function elimina(ActivityService $activityService, $id)
    {
        $activityService->eliminaAttivitaClient($id);

        $this->totale = $this->ragazzoConPresenzeAttivita->activitiesMensili->sum('pivot.costo')
            + $this->ragazzoConPresenzeAttivita->activitiesOrario->sum('pivot.costo');
    }

    public function render()
    {
        return view('livewire.statistiche.presenze-clienti');
    }
}
