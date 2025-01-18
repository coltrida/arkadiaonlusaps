<?php

namespace App\Livewire\Client;

use App\Services\ActivityService;
use App\Services\ClientService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;

class FormPresenzeAttivita extends Component
{

    public $quantita;
    public $activity_id;
    public $clients = [];
    public $giorno;
    public $note;
    public $bloccaQuantita = false;

    public function attivitaSelezionata(ActivityService $activityService)
    {
        $this->clients = $activityService->listaIdClientsFromIdActivity($this->activity_id);
        $attivita = $activityService->activityFromId($this->activity_id);
        if ($attivita->tipo === 'mensile'){
            $this->quantita = 1;
            $this->bloccaQuantita = true;
        } else {
            $this->bloccaQuantita = false;
        }
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

        if ($res[1] == 'success'){
            $this->reset('activity_id', 'giorno', 'quantita', 'note');
            $this->clients = [];

            $tipo = 'inserimento presenze attività - cliente';
            $data = 'Inserita presenza attività con id = '.$this->activity_id.' per i clienti: '. implode(",",$this->clients);
            $logService->scriviLog(auth()->id(), $tipo, $data);
        }

        $this->dispatch('aggiungiPresenzaAttivita', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function render(ActivityService $activityService, ClientService $clientService)
    {
        return view('livewire.client.form-presenze-attivita', [
            'listaAttivita' => $activityService->listaAttivita(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ]);
    }
}
