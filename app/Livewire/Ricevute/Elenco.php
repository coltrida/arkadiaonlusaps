<?php

namespace App\Livewire\Ricevute;

use App\Models\Activity;
use App\Services\ActivityService;
use App\Services\LogService;
use App\Services\RicevuteService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Elenco extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $dataRicevuta;
    public $nominativo;
    public $importo;
    public $modalitaPagamento;
    public $descrizione;
    public $progressivo;
    public $citta;
    public $indirizzo;
    public $cap;
    public $pivaCodfisc;
    public $testo;

    public function inserisci(RicevuteService $ricevuteService, LogService $logService)
    {
        $request = new Request();
        $request->merge([
            'dataRicevuta' => $this->dataRicevuta,
            'nominativo' => $this->nominativo,
            'importo' => $this->importo,
            'modalitaPagamento' => $this->modalitaPagamento,
            'descrizione' => $this->descrizione,
            'progressivo' => $this->progressivo,
            'citta' => $this->citta,
            'indirizzo' => $this->indirizzo,
            'cap' => $this->cap,
            'pivaCodfisc' => $this->pivaCodfisc,
        ]);

        $res = $ricevuteService->inserisciRicevuta($request);

        $tipo = 'inserimento ricevuta';
        $data = 'Ricevuta con data: '.$this->dataRicevuta.' inserita, per il nominativo: '.$this->nominativo;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset();

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

    public function render(RicevuteService $ricevuteService)
    {
        return view('livewire.ricevute.elenco', [
            'listaRicevutePaginate' => $ricevuteService->listaRicevutePaginate($this->testo)
        ]);
    }
}
