<?php

namespace App\Livewire\Client;

use App\Services\ActivityService;
use App\Services\ClientService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PresenzeAttivita extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $activity_id;
    public $clients = [];
    public $giorno;
    public $quantita;
    public $note;

    public function attivitaSelezionata(ActivityService $activityService)
    {
        $this->clients = $activityService->listaIdClientsFromIdActivity($this->activity_id);
    }

    public function inserisci(ActivityService $activityService, LogService $logService)
    {
        $request = new Request();
        $request->merge([
            'activity_id' => $this->activity_id,
            'clients' => $this->clients,
            'giorno' => $this->giorno,
            'quantita' => $this->quantita,
            'note' => $this->note,
        ]);

        $res = $activityService->inserisciAttivitaClient($request);
        $tipo = 'inserimento presenze attività - cliente';
        $data = 'Inserita presenza attività con id = '.$this->activity_id.' per i clienti: '. implode(",",$this->clients);
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('activity_id', 'giorno', 'quantita', 'note');
        $this->clients = [];

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function elimina(ActivityService $activityService, LogService $logService, $idAssociazione)
    {
        $activityService->eliminaAttivitaClient($idAssociazione);

        $tipo = 'eliminazione presenza attività - cliente';
        $data = 'Eliminata presenza attività con id = '.$idAssociazione;
        $logService->scriviLog(auth()->id(), $tipo, $data);
    }


    public function render(ActivityService $activityService, ClientService $clientService)
    {
        return view('livewire.client.presenze-attivita', [
            'listaAttivitaClientPaginate' => $clientService->listaAttivitaClientPaginate(),
            'listaAttivita' => $activityService->listaAttivita(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
