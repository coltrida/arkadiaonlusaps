<?php

namespace App\Livewire\Client;

use App\Services\ActivityService;
use App\Services\ClientService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AssociaAttivita extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $activity_id;
    public $clients = [];
    public $testoRicerca;

    public function inserisci(ActivityService $activityService, LogService $logService)
    {
        $request = new Request();
        $request->merge([
            'activity_id' => $this->activity_id,
            'clients' => $this->clients,
        ]);

        $res = $activityService->inserisciAssociazioneAttivitaClient($request);
        $tipo = 'associazione attività - cliente';
        $data = 'Associata attività con id = '.$this->activity_id.' con i clienti: '. implode(",",$this->clients);
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('activity_id');
        $this->clients = [];

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function elimina(ActivityService $activityService, LogService $logService, $idAssociazione)
    {
        $activityService->eliminaAssociazioneAttivitaCliente($idAssociazione);

        $tipo = 'eliminazione associazione attività - cliente';
        $data = 'Eliminata associazione con id = '.$idAssociazione;
        $logService->scriviLog(auth()->id(), $tipo, $data);
    }


    public function render(ActivityService $activityService, ClientService $clientService)
    {
        return view('livewire.client.associa-attivita', [
            'listaAssociazioniAttivitaClientPaginate' => $activityService->listaAssociazioniAttivitaClientPaginate($this->testoRicerca),
            'listaAttivita' => $activityService->listaAttivita(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
