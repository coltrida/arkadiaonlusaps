<div class="min-h-screen">

    <div class="grid gap-6 mb-6 md:grid-cols-4 text-center">
        <div>
            <select wire:model="user_id"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                <option selected value="">Operatori</option>
                @foreach($listaOperatori as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select wire:model="settimanaSelezionata"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                @foreach($settimane as $index => $item)
                    <option value="{{$index}}">{{$item}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button wire:click="visualizza" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Visualizza
            </button>
        </div>
    </div>

    @if($visualizzaStatistiche)

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
                            {{$item->giorno}}
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
    @endif
</div>






