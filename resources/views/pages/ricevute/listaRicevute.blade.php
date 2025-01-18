<x-layouts.stile>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="min-h-screen">
        <livewire:ricevute.form-inserimento-ricevute />
        <livewire:ricevute.elenco lazy />
    </div>

</x-layouts.stile>
