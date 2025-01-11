<?php

namespace App\Livewire\Client;

use App\Models\Client;
use App\Services\ActivityService;
use App\Services\ClientService;
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

    public function inserisci(ActivityService $activityService)
    {
        $request = new Request();
        $request->merge([
            'activity_id' => $this->activity_id,
            'clients' => $this->clients,
        ]);

        $res = $activityService->inserisciAssociazioneAttivitaClient($request);

        $this->reset('activity_id');
        $this->clients = [];

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function elimina(ActivityService $activityService, $idAssociazione)
    {
        $activityService->eliminaAssociazioneAttivitaCliente($idAssociazione);
    }


    public function render(ActivityService $activityService, ClientService $clientService)
    {
        return view('livewire.client.associa-attivita', [
            'listaAssociazioniAttivitaClientPaginate' => $activityService->listaAssociazioniAttivitaClientPaginate(),
            'listaAttivita' => $activityService->listaAttivita(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
