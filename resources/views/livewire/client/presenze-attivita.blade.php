<div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
            <thead class="text-xs uppercase bg-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Giorno
                </th>
                <th scope="col" class="px-6 py-3">
                    Ragazzo
                </th>
                <th scope="col" class="px-6 py-3">
                    Attività
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Quantità
                </th>
                <th scope="col" class="px-2 py-3 text-center">
                    Azioni
                </th>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($listaAttivitaClientPaginate as $item)
                <tr class="bg-gray-800 hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{$item->giornoformattato}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{$item->client->name}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{$item->activity->name}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white text-center">
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
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        # {{$item->id}}
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{$listaAttivitaClientPaginate->links(data: ['scrollTo' => false])}}
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
                            text: "la presenza è stata eliminata.",
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




