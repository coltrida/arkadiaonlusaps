<x-layouts.stile>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="min-h-screen">
        <livewire:statistiche.form-presenze-clienti />
        <livewire:statistiche.presenze-clienti lazy />
        <livewire:statistiche.modifica-saldo-presenze-clienti />
    </div>

</x-layouts.stile>
