<?php

namespace App\Livewire\User;

use App\Services\LogService;
use App\Services\PresenzaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class FormPresenzeOperatore extends Component
{
    public $giorno;
    public $ore;

    public function inserisci(PresenzaService $presenzaService, LogService $logService)
    {
        $giorno = $this->giorno ? Carbon::make($this->giorno) : null;
        $request = new Request();
        $request->merge([
            'user_id' => auth()->id(),
            'giorno' => $giorno,
            'ore' => $this->ore,
            'mese' => $giorno?->month,
            'anno' => $giorno?->year,
            'settimana' => $giorno?->weekOfYear,
        ]);
        $res = $presenzaService->inserisciPresenza($request);

        if ($res[1] == 'success'){
            $this->reset('giorno', 'ore');

            $tipo = 'inserimento presenze operatore';
            $data = 'Inserita presenza operatore con idUser = '.auth()->id().' per il giorno: '.$request->giorno.' di '.$request->ore.' ore';
            $logService->scriviLog(auth()->id(), $tipo, $data);
        }


        $this->dispatch('aggiungiPresenzaOperatore', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function render()
    {
        return view('livewire.user.form-presenze-operatore');
    }
}
