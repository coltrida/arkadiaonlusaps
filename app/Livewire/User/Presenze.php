<?php

namespace App\Livewire\User;

use App\Services\PresenzaService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Presenze extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $giorno;
    public $ore;

    public function inserisci(PresenzaService $presenzaService)
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

        $this->reset('giorno', 'ore');

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function elimina(PresenzaService $presenzaService, $idPresenza)
    {
        $presenzaService->eliminaPresenza($idPresenza);
    }

    public function render(PresenzaService $presenzaService)
    {
        return view('livewire.user.presenze', [
            'listaPresenzePaginate' => $presenzaService->listaPresenzePaginate(auth()->id())
        ]);
    }
}
