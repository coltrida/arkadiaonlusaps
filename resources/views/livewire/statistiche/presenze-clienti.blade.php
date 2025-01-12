<div class="min-h-screen">
    <div class="grid gap-6 mb-6 md:grid-cols-4 text-center">
        <div>
            <select wire:model="client_id"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                <option selected value="">Ragazzi</option>
                @foreach($listaRagazzi as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select wire:model="meseSelezionato"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                @for($mese = 1; $mese <= 12; $mese++)
                    <option value="{{$mese}}">{{$mese}}</option>
                @endfor
            </select>
        </div>

        <div>
            <select wire:model="annoSelezionato"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                @for($anno = $annoInizio; $anno <= $annoOggi; $anno++)
                    <option value="{{$anno}}">{{$anno}}</option>
                @endfor
            </select>
        </div>

        <div>
            <button wire:click="visualizza"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Visualizza
            </button>
        </div>
    </div>

    @if($visualizzaStatistiche)

        <h2 class="text-white text-2xl" style="margin-top: 70px">Attività Mensili</h2>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
                <thead class="text-xs uppercase bg-gray-700 text-white">
                <tr class="text-center">
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Attività
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Costo Mensile
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Attività
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($ragazzoConPresenzeAttivita->activitiesMensili as $item)
                    <tr class="text-center text-white border-b bg-gray-800 border-gray-700 hover:bg-gray-50 hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{$item->pivot->id}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{$item->name}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{$item->tipo}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            € {{$item->pivot->costo}}
                        </th>
                        <td class="px-6 py-4 flex justify-center">
                            <button
                                wire:click="elimina({{$item->pivot->id}})"
                                wire:confirm="Sei sicuro che vuoi eliminare {{$item->name}}?"
                                title="elimina"
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-pink-800">
                                    <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        <svg class="w-[20px] h-[20px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <h2 class="text-white text-2xl" style="margin-top: 70px">Attività Orarie</h2>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
                <thead class="text-xs uppercase bg-gray-700 text-white">
                <tr class="text-center">
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Attività
                    </th>
                    <th scope="col" class="px-6 py-3">
                        giorno
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Costo Orario
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Attività
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($ragazzoConPresenzeAttivita->activitiesOrario as $item)
                    <tr class="text-center text-white border-b bg-gray-800 border-gray-700 bg-gray-50 hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{$item->pivot->id}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{$item->name}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{$item->pivot->giorno}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{$item->tipo}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            € {{$item->pivot->costo}}
                        </th>
                        <td class="px-6 py-4 flex justify-center">
                            <button
                                wire:click="elimina({{$item->pivot->id}})"
                                wire:confirm="Sei sicuro che vuoi eliminare {{$item->name}}?"
                                title="elimina" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-pink-800">
                                    <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        <svg class="w-[20px] h-[20px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <h2 class="text-3xl text-white text-center" style="margin-top: 70px">Totale: € {{$totale}}</h2>

    @endif
</div>





