<div>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="grid gap-6 mb-6 md:grid-cols-5">
            <input wire:model.live.debounce.400ms="testo"
                   type="text"
                   class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-600 border-white placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                   placeholder="ricerca destinatario..." />
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-400 my-4">
            <thead class="text-xs uppercase bg-gray-700 text-white">
            <tr>
                <th scope="col" class="lg:px-6 px-2 py-3">

                </th>
                <th scope="col" class="lg:px-6 px-2 py-3">
                    Prog.
                </th>
                <th scope="col" class="px-6 py-3">
                    Destinatario
                </th>
                <th scope="col" class="px-6 py-3">
                    Importo
                </th>
                <th scope="col" class="px-2 py-3">
                    Data Ricevuta
                </th>
                <th scope="col" class="px-2 py-3">
                    Descrizione
                </th>
                <th scope="col" class="px-2 py-3">
                    Indirizzo
                </th>
                <th scope="col" class="px-2 py-3">
                    Città
                </th>
                <th scope="col" class="px-2 py-3">
                    Cap
                </th>
                <th scope="col" class="px-2 py-3">
                    p.iva Cod. fisc
                </th>
                <th scope="col" class="px-2 py-3">
                    modalità Pagamento
                </th>
                <th scope="col" class="px-2 py-3">
                    anno
                </th>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($listaRicevutePaginate as $item)
                <tr class="bg-gray-800 hover:bg-gray-600">
                    <td class="lg:px-6 px-2 py-4 flex justify-center">
                        <button
                            title="elimina" @click="$dispatch('info', { id: '{{$item->id}}' })"
                            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-pink-800">
                                    <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        <svg class="w-[20px] h-[20px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                          <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                        </button>

                        <button wire:click="stampa({{$item}})" title="stampa" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                        <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        </button>

                    </td>
                    <td class="lg:px-6 px-2 py-4 whitespace-nowrap text-white text-center">
                        {{$item->progressivo}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->destinatario}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        € {{$item->importo}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->dataformattata}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->descrizione}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->indirizzo}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->citta}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->cap}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->pivaCodfisc}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->modalitaPagamento}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->anno}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{$item->id}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mb-5">
            {{ $listaRicevutePaginate->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

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
                    component.elimina(event.detail.id).then(function (res){
                        Swal.fire({
                            title: "Eliminato!",
                            text: "la ricevuta è stata eliminata.",
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




