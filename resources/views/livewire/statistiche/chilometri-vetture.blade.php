<div class="min-h-screen">

    <div class="grid gap-6 mb-6 md:grid-cols-4 text-center">
        <div>
            <select wire:model="car_id"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                <option selected value="">Vetture</option>
                @foreach($listaVetture as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>


        <div x-data="{ open: false }">
            <!-- Finestra fissa -->
            <div x-show="open" x-transition class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-black rounded-lg w-96 h-72 overflow-hidden shadow-lg">
                    <!-- Header della finestra -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h2 class="text-lg font-semibold">Mese</h2>
                        <button @click="open = false" class="text-red-500">Chiudi</button>
                    </div>

                    <!-- Lista con scorrimento -->
                    <div class="p-4 overflow-y-auto h-56">
                        <div class="grid gap-2 grid-cols-4 text-center">
                            @for($mese = 1; $mese <= 12; $mese++)
                                <div class="flex items-center mb-4">
                                    <input wire:model="mesi" id="default-checkbox-{{$mese}}" type="checkbox" value="{{$mese}}" class="w-6 h-6 rounded focus:ring-blue-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                                    <label for="default-checkbox-{{$mese}}" class="ms-2 text-sm font-medium text-gray-300">{{$mese}}</label>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <button @click="open = true" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Sel. Mesi
            </button>
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
                        Km Percorsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Vettura
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Passeggeri
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Azioni
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($trips as $item)
                    <tr class="bg-gray-800 hover:bg-gray-600">
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{$item->id}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{$item->giorno}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{$item->kmPercorsi}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            {{$item->car->name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            @foreach($item->clients as $client)
                                {{$client->name}} <br>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 flex justify-center">
                            <button
                                title="elimina" @click="$dispatch('info', { id: '{{$item->id}}' })"
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
        <h3 class="text-white text-3xl">Km Totali: {{$trips->sum('kmPercorsi')}}</h3>
    @endif

    <script>
        window.addEventListener('info', event => {
            Swal.fire({
                title: "Sei sicuro?",
                text: 'stai per cancellare elemento con id = ' + event.detail.id,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, elimina"
            }).then((result) => {
                if (result.isConfirmed) {
                    let component = @this;
                    component.elimina(event.detail.id).then(function (res){
                        Swal.fire({
                            title: "Eliminato!",
                            text: "Elemeno è stata eliminato.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    })
                }
            });
        });
    </script>

</div>







