<?php

namespace App\Livewire\Pdf;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Ricevuta extends Component
{
    public $ricevuta;

    public function mount($ricevuta)
    {
        $this->ricevuta = $ricevuta;
    }

    #[Layout('layouts.stilePdf')]
    public function render()
    {
        return view('livewire.pdf.ricevuta');
    }
}
