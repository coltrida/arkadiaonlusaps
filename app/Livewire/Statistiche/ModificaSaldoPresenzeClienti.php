<?php

namespace App\Livewire\Statistiche;

use Livewire\Attributes\On;
use Livewire\Component;

class ModificaSaldoPresenzeClienti extends Component
{
    public $dataModifica = [];
    public $importoModifica = [];
    public $causaleModifica = [];
    public $saldoOriginale;
    public $nuovoSaldo;
    public $visualizzaModificheSaldo = false;
    public $visualizza = false;
    public $ragazzoConPresenzeAttivita;
    public $mese;
    public $anno;
    public $nrModifiche;

    #[On('datiCaricati')]
    public function caricaSaldo($saldoOriginale, $ragazzoConPresenzeAttivita, $mese, $anno)
    {
        $this->visualizzaModificheSaldo = false;
        $this->nrModifiche = 1;
        $this->reset('nuovoSaldo', 'dataModifica', 'importoModifica', 'causaleModifica');
        $this->saldoOriginale = $saldoOriginale;
        $this->ragazzoConPresenzeAttivita = $ragazzoConPresenzeAttivita;
        $this->anno = $anno;
        $this->mese = $mese;
        $this->visualizza = true;
    }

    public function inserisciModifica()
    {
        $this->nrModifiche++;
    }

    public function modificaSaldo()
    {
        $this->nuovoSaldo = $this->saldoOriginale;
        for ($i=0; $i<count($this->importoModifica); $i++){
            $this->nuovoSaldo -= $this->importoModifica[$i];
        }

        $this->visualizzaModificheSaldo = true;
    }

    public function render()
    {
        return view('livewire.statistiche.modifica-saldo-presenze-clienti');
    }
}
