<?php

namespace App\Livewire\Ricevute;

use App\Models\Activity;
use App\Models\Ricevuta;
use App\Services\ActivityService;
use App\Services\LogService;
use App\Services\RicevuteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

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

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);

        if ($res[2]){
            $tipo = 'inserimento ricevuta';
            $data = 'Ricevuta con id: '.$res[2]->id.' inserita, per il nominativo: '.$this->nominativo;
            $logService->scriviLog(auth()->id(), $tipo, $data);



            $this->reset();

            $ricevuta = $res[2];
            $pdf = Pdf::loadView('livewire.pdf.ricevuta', compact('ricevuta'));
            $fileName = Str::slug($ricevuta->progressivo."-".$ricevuta->anno."-".$ricevuta->destinatario).".pdf";

            return response()->streamDownload(function () use($pdf) {
                echo $pdf->stream();
            }, $fileName);
        }
    }

    public function stampa(Ricevuta $ricevuta)
    {
        $pdf = Pdf::loadView('livewire.pdf.ricevuta', compact('ricevuta'));
        $fileName = Str::slug($ricevuta->progressivo."-".$ricevuta->anno."-".$ricevuta->destinatario).".pdf";
        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, $fileName);
    }

    public function elimina(RicevuteService $ricevuteService, LogService $logService, $id)
    {
        $ricevuteService->eliminaRicevuta($id);

        $tipo = 'eliminazione ricevuta';
        $data = 'Ricevuta con id = '.$id.' eliminata';
        $logService->scriviLog(auth()->id(), $tipo, $data);
    }

    public function render(RicevuteService $ricevuteService)
    {
        return view('livewire.ricevute.elenco', [
            'listaRicevutePaginate' => $ricevuteService->listaRicevutePaginate($this->testo)
        ]);
    }
}
