<div>
    @if($visualizzaStatistiche)

        <div wire:loading.remove>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
                <thead class="text-xs uppercase bg-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        giorno
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ore
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($presenze as $item)
                    <tr class="bg-gray-800 hover:bg-gray-600">
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            # {{$item->id}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{$item->giornoformattato}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{$item->ore}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <h3 class="text-white text-3xl">Totale ore: {{$presenze->sum('ore')}}</h3>
        <h3 class="text-white text-3xl">Saldo ore: {{$saldoOre}}</h3>

        </div>
    @endif
</div>






