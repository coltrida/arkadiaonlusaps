<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Elenco extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $visualizzaListaOperatori = true;
    public $name;
    public $email;
    public $oresettimanali;
    public $oresaldo;
    public $password;
    public $operatoreDaModificare;

    public function inserisciOrModifica(UserService $userService)
    {
        $request = new Request();
        $request->merge([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : null,
            'oresettimanali' => $this->oresettimanali,
            'oresaldo' => 0,
            'role' => 0,
        ]);
        if ($this->visualizzaListaOperatori){
            $res = $userService->inserisciUser($request);
        } else {
            $res = $userService->modificaUser($this->operatoreDaModificare, $request);
        }

        $this->reset('name', 'email', 'password', 'oresettimanali', 'operatoreDaModificare');
        $this->visualizzaListaOperatori = true;

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function modifica(User $item)
    {
        $this->visualizzaListaOperatori = false;
        $this->name = $item->name;
        $this->email = $item->email;
        $this->oresettimanali = $item->oresettimanali;
        $this->oresaldo = $item->oresaldo;
        $this->operatoreDaModificare = $item;
    }

    public function annulla()
    {
        $this->visualizzaListaOperatori = true;
        $this->reset('name', 'email', 'oresettimanali', 'oresaldo');
    }

    public function elimina(UserService $userService, $idUser)
    {
        $userService->eliminaUser($idUser);
    }

    public function render(UserService $userService)
    {
        return view('livewire.user.elenco', [
            'listaOperatori' => $userService->listaOperatoriPaginate()
        ]);
    }
}
