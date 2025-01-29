<?php

namespace App\Livewire\Calendario;

use App\Models\Appuntamento;
use Livewire\Component;

class Calendario extends Component
{
    public $appuntamenti;

    protected $listeners = ['SalvaAppuntamento' => 'aggiornaAppuntamenti'];

    public function mount()
    {
        $this->caricaAppuntamenti();
    }

    public function aggiornaAppuntamenti()
    {
        $this->caricaAppuntamenti();
    }

    public function caricaAppuntamenti()
    {
        $this->appuntamenti = Appuntamento::all()->map(function ($appuntamento) {
            return [
                'title' => $appuntamento->titolo,
                'start' => $appuntamento->startDate,
                'end' => $appuntamento->endDate,
            ];
        });
    }

    public function render()
    {
        return view('livewire.calendario.calendario');
    }
}
