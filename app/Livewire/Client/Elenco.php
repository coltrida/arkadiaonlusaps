<?php

namespace App\Livewire\Client;

use App\Models\Client;
use App\Services\ClientService;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Elenco extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $visualizzaListaClienti = true;
    public $name;
    public $voucher;
    public $scadenza;
    public $clienteDaModificare;
    public $testoRicerca;

    public function inserisciOrModifica(ClientService $clientService)
    {
        $request = new Request();
        $request->merge([
            'name' => $this->name,
            'voucher' => $this->voucher,
            'scadenza' => $this->scadenza,
        ]);

        if ($this->visualizzaListaClienti){
            $res = $clientService->inserisci($request);
        } else {
            $res = $clientService->modifica($this->clienteDaModificare, $request);
        }

        $this->reset('name', 'voucher', 'scadenza', 'clienteDaModificare');
        $this->visualizzaListaClienti = true;

        $this->dispatch('aggiungi', [
            'testo' => $res[0],
            'icon' => $res[1],
        ]);
    }

    public function elimina(ClientService $clientService, $idClient)
    {
        $clientService->elimina($idClient);
    }


    public function modifica(Client $item)
    {
        $this->visualizzaListaClienti = false;
        $this->name = $item->name;
        $this->voucher = $item->voucher;
        $this->scadenza = $item->scadenza;
        $this->clienteDaModificare = $item;
    }

    public function annulla()
    {
        $this->visualizzaListaClienti = true;
        $this->reset('name', 'voucher', 'scadenza');
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.client.elenco', [
            'listaRagazziPaginate' => $clientService->listaRagazziPaginate($this->testoRicerca)
        ]);
    }
}
