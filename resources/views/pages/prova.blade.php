<x-layouts.stile>
    <x-slot:title>
        {{$title}}
    </x-slot:title>

    <h2>{{$title}}</h2>

    <x-users.user-list :listaOperatori="$listaOperatori"></x-users.user-list>


</x-layouts.stile>
