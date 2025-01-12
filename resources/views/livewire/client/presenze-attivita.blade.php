<div class="min-h-screen">

    <div class="grid gap-6 mb-6 md:grid-cols-7">
        <div>
            <select wire:model="activity_id" wire:change="attivitaSelezionata"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    <option selected value="">Attività</option>
                @foreach($listaAttivita as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Modal toggle -->
        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-500 dark:focus:ring-blue-800" type="button">
            Lista Clienti
        </button>

        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold text-white">
                            Lista Clienti
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4 overflow-y-auto" style="height: 200px">
                        <div class="text-base leading-relaxed text-gray-400">
                            @foreach($listaRagazzi as $client)
                                <div class="flex items-center mb-4">
                                    <input wire:model="clients" id="default-checkbox-{{$client->id}}" type="checkbox" value="{{$client->id}}" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                                    <label for="default-checkbox-{{$client->id}}" class="ms-2 text-sm font-medium text-gray-300">{{$client->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <input wire:model="giorno"
                   type="date"
                   class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"  />
        </div>

        <div>
            <input wire:model="quantita"
                   type="number"
                   class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                   placeholder="q.tà" />
        </div>
        <div>
            <input wire:model="note" type="text"
                   class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                   placeholder="note" />
        </div>

        <div>
            <button wire:click="inserisci" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Inserisci
            </button>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
            <thead class="text-xs uppercase bg-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    Ragazzo
                </th>
                <th scope="col" class="px-6 py-3">
                    Giorno
                </th>
                <th scope="col" class="px-6 py-3">
                    Attività
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantità
                </th>
                <th scope="col" class="px-2 py-3">
                    Azioni
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($listaAttivitaClientPaginate as $item)
                <tr class="bg-gray-800 hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        # {{$item->id}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{$item->client->name}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{$item->giorno}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{$item->activity->name}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{$item->quantita}}
                    </th>
                    <td class="px-6 py-4 text-center">
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

    <div class="mt-4">
        {{$listaAttivitaClientPaginate->links(data: ['scrollTo' => false])}}
    </div>

    <script>
        window.addEventListener('aggiungi', event => {
            Swal.fire({
                title: "Esito",
                text: event.detail[0].testo,
                icon: event.detail[0].icon,
                showConfirmButton: false,
                timer: 3000
            });
        });

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
                            text: "l'associazione è stata eliminata.",
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




