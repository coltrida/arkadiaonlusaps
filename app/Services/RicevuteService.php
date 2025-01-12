<?php

namespace App\Services;

use App\Models\Ricevuta;
use Carbon\Carbon;

class RicevuteService
{
    public function ricevutaById($id)
    {
        return Ricevuta::find($id);
    }

    public function listaRicevutePaginate($testo)
    {
        return Ricevuta::where('destinatario', 'like', '%'.$testo.'%')->latest()->paginate(5);
    }

    public function inserisciRicevuta($request)
    {
        $anno = Carbon::make($request->dataRicevuta)->year;

        if ($request->progressivo){
            $progressivo = $request->progressivo;
            $ricevutaGiaPresente = Ricevuta::where([
                ['progressivo', $progressivo],
                ['anno', $anno]
            ])->first();
            if ($ricevutaGiaPresente){
                return ['numero progressivo già presente - inserimento non effettuato', 'error', ''];
            }
        } else {
            $ultimaRicevuta = Ricevuta::where('anno', $anno)->orderBy('progressivo', 'DESC')->first();
            $progressivo = $ultimaRicevuta ? $ultimaRicevuta->progressivo + 1 : 1;
        }

        $ricevuta = Ricevuta::create([
            'destinatario' => $request->nominativo,
            'indirizzo' => $request->indirizzo,
            'citta' => $request->citta,
            'cap' => $request->cap,
            'pivaCodfisc' => $request->pivaCodfisc,
            'importo' => $request->importo,
            'modalitaPagamento' => $request->modalitaPagamento,
            'descrizione' => $request->descrizione,
            'dataRicevuta' => $request->dataRicevuta,
            'anno' => $anno,
            'progressivo' => $progressivo,
        ]);

        return ["ricevuta con id = $ricevuta->id inserita", 'success', $ricevuta];
    }

    public function eliminaRicevuta($id)
    {
        Ricevuta::find($id)->delete();
    }
}
