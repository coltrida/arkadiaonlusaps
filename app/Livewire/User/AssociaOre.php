<?php

namespace App\Livewire\User;

use App\Services\LogService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AssociaOre extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $user_id;
    public $oresettimanali;

    public function associa(UserService $userService, LogService $logService)
    {
        $request = new Request();
        $request->merge([
            'user_id' => $this->user_id,
            'oresettimanali' => $this->oresettimanali,
        ]);
        $res = $userService->associaOperatoreOresettimanali($request);
        $tipo = 'Associazione Operatore - Ore';
        $data = 'Associato operatore con id: '.$this->user_id.' con '.$this->oresettimanali.' ore settimanali';
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('user_id', 'oresettimanali');

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function render(UserService $userService)
    {
        return view('livewire.user.associa-ore', [
            'listaOperatori' => $userService->listaOperatori(),
            'listaOperatoriPaginate' => $userService->listaOperatoriPaginate()
        ]);
    }
}
