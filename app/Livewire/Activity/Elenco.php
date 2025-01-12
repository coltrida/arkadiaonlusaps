<?php

namespace App\Livewire\Activity;

use App\Models\Activity;
use App\Services\ActivityService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Elenco extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $visualizzaLista = true;
    public $name;
    public $tipo;
    public $cost;
    public $attivitaDaModificare;
    public $testoRicerca;

    public function inserisciOrModifica(ActivityService $activityService, LogService $logService)
    {
        $request = new Request();
        $request->merge([
            'name' => $this->name,
            'tipo' => $this->tipo,
            'cost' => $this->cost,
        ]);

        if ($this->visualizzaLista){
            $res = $activityService->inserisci($request);
            $tipo = 'inserimento attività';
            $data = 'Attività: '.$this->name.' inserita';
            $logService->scriviLog(auth()->id(), $tipo, $data);
        } else {
            $res = $activityService->modifica($this->attivitaDaModificare, $request);
            $tipo = 'modifica attività';
            $data = 'Attività: '.$this->name.' modificata';
            $logService->scriviLog(auth()->id(), $tipo, $data);
        }

        $this->reset('name', 'tipo', 'cost', 'attivitaDaModificare');
        $this->visualizzaLista = true;

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function elimina(ActivityService $activityService, LogService $logService, $idAttivita)
    {
        $activityService->elimina($idAttivita);

        $tipo = 'eliminazione attività';
        $data = 'Attività con id = '.$idAttivita.' eliminata';
        $logService->scriviLog(auth()->id(), $tipo, $data);
    }


    public function modifica(Activity $item)
    {
        $this->visualizzaLista = false;
        $this->name = $item->name;
        $this->tipo = $item->tipo;
        $this->cost = $item->cost;
        $this->attivitaDaModificare = $item;
    }

    public function annulla()
    {
        $this->visualizzaLista = true;
        $this->reset('name', 'tipo', 'cost');
    }

    public function render(ActivityService $activityService)
    {
        return view('livewire.activity.elenco', [
            'listaAttivitaPaginate' => $activityService->listaAttivitaPaginate($this->testoRicerca)
        ]);
    }
}
