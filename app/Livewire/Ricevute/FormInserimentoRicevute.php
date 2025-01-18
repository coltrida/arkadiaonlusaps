<?php

namespace App\Livewire\Ricevute;

use App\Services\LogService;
use App\Services\RicevuteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class FormInserimentoRicevute extends Component
{

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

        $this->dispatch('aggiungiRicevuta', [
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

    public function render()
    {
        return view('livewire.ricevute.form-inserimento-ricevute');
    }
}
