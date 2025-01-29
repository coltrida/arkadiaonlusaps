<div>
    @if($visualizzaStatistiche)

        <div wire:loading.remove>
            <h2 class="text-white text-3xl" style="margin-top: 70px">Attività Mensili
                - {{$ragazzoConPresenzeAttivita->name}} - {{$mese}}/{{$anno}}</h2>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
                    <thead class="text-xs uppercase bg-gray-700 text-white">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            Attività
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipo
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Costo Mensile
                        </th>
                        {{--<th scope="col" class="px-2 py-3">
                            Attività
                        </th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ragazzoConPresenzeAttivita->asociazionimensili as $item)
                        <tr class="text-center text-white border-b bg-gray-800 border-gray-700 hover:bg-gray-50 hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                {{$item->activity->name}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                {{$item->activity->tipo}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                € {{$item->activity->cost}}
                            </th>
                            {{--<td class="px-6 py-4 flex justify-center">
                                <button
                                    title="elimina" @click="$dispatch('info', { id: '{{$item->id}}' })"
                                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-pink-800">
                                        <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                            <svg class="w-[20px] h-[20px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                              <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                </button>
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="text-white text-3xl" style="margin-top: 70px">Attività Orarie
                - {{$ragazzoConPresenzeAttivita->name}} - {{$mese}}/{{$anno}}</h2>

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
                                {{\Carbon\Carbon::make($item->pivot->giorno)->format('d-m-Y')}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                {{$item->tipo}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                € {{$item->pivot->costo}}
                            </th>
                            <td class="px-6 py-4 flex justify-center">
                                <button
                                    title="elimina" @click="$dispatch('info', { id: '{{$item->pivot->id}}' })"
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-pink-800">
                                        <span
                                            class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                            <svg class="w-[20px] h-[20px] text-white" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 fill="currentColor" viewBox="0 0 24 24">
                                              <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd"/>
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
        </div>
    @endif

    @script
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
                    component.elimina(event.detail.id).then(function (res) {
                        Swal.fire({
                            title: "Eliminato!",
                            text: "l'elemento è stato eliminato.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    })
                }
            });
        });
    </script>
    @endscript
</div>





