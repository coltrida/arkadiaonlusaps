<?php

namespace App\Livewire\Statistiche;

use Livewire\Attributes\On;
use Livewire\Component;

class ModificaSaldoPresenzeClienti extends Component
{
    public $dataModifica;
    public $importoModifica;
    public $causaleModifica;
    public $saldoOriginale;
    public $nuovoSaldo;
    public $visualizzaModificheSaldo = false;
    public $visualizza = false;
    public $ragazzoConPresenzeAttivita;
    public $mese;
    public $anno;

    #[On('datiCaricati')]
    public function caricaSaldo($saldoOriginale, $ragazzoConPresenzeAttivita, $mese, $anno)
    {
        $this->saldoOriginale = $saldoOriginale;
        $this->ragazzoConPresenzeAttivita = $ragazzoConPresenzeAttivita;
        $this->anno = $anno;
        $this->mese = $mese;
        $this->visualizza = true;
    }

    public function modificaSaldo()
    {
        $this->nuovoSaldo = $this->saldoOriginale - $this->importoModifica;
        $this->visualizzaModificheSaldo = true;
    }

    public function render()
    {
        return view('livewire.statistiche.modifica-saldo-presenze-clienti');
    }
}
