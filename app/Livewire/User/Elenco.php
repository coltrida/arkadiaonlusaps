<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Elenco extends Component
{

    public $listaOperatori;
    public $visualizzaListaOperatori = true;
    public $name;
    public $email;
    public $oresettimanali;
    public $oresaldo;
    public $password;


    public function mount($listaOperatori)
    {
        $this->listaOperatori = $listaOperatori;
    }

    public function inserisciOrModifica(UserService $userService)
    {
        $request = new Request();
        $request->merge([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'oresettimanali' => $this->oresettimanali,
            'oresaldo' => 0,
            'role' => 0,
        ]);
        $nuovoOperatore = $userService->inserisciUser($request);
        $this->listaOperatori->unshift($nuovoOperatore);
        $this->dispatch('aggiungi');
    }

    public function modifica(User $item)
    {
        $this->visualizzaListaOperatori = false;
        $this->name = $item->name;
        $this->email = $item->email;
        $this->oresettimanali = $item->oresettimanali;
        $this->oresaldo = $item->oresaldo;
    }

    public function annulla()
    {
        $this->visualizzaListaOperatori = true;
        $this->reset('name', 'email', 'oresettimanali', 'oresaldo');
    }

    public function elimina(UserService $userService, $idUser)
    {
        $userService->eliminaUser($idUser);
        $this->listaOperatori = $this->listaOperatori->where('id', '!=', $idUser);
    }

    public function render()
    {
        return view('livewire.user.elenco');
    }
}
