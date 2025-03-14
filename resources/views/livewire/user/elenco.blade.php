<div class="min-h-screen">

    <div class="grid gap-6 mb-6 md:grid-cols-6 pt-4">
        <div>
            <input wire:model="name"
                   type="text"
                   class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                   placeholder="nome operatore" />
        </div>
        <div>
            <input wire:model="email"
                   type="email"
                   class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                   placeholder="email" />
        </div>
        <div>
            <input wire:model="oresettimanali"
                   type="number"
                   class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                   placeholder="ore settimanali"/>
        </div>
        <div>
            @if($visualizzaListaOperatori)
                <input wire:model="password"
                       type="text"
                       class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                       placeholder="password" />
            @else
                <input wire:model="oresaldo"
                       type="text"
                       class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                       placeholder="ore saldo" />
            @endif
        </div>
        <div>
            <button wire:click="inserisciOrModifica" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{$visualizzaListaOperatori ? 'Inserisci' : 'Modifica'}}
            </button>
        </div>
        @if(!$visualizzaListaOperatori)
        <div>
            <button wire:click="annulla" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Annulla
            </button>
        </div>
        @endif
    </div>

    @if($visualizzaListaOperatori)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
                <thead class="text-xs uppercase bg-gray-700 text-white">
        <tr>
            <th scope="col" class="px-6 py-3">
                Lista Operatori
            </th>
            <th scope="col" class="px-6 py-3">
                email
            </th>
            <th scope="col" class="px-6 py-3">
                ore settimanali
            </th>
            <th scope="col" class="px-6 py-3">
                ore saldo
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($listaOperatori as $item)
            <tr class="bg-gray-800 hover:bg-gray-600">
                <td class="px-6 py-4 whitespace-nowrap text-white">
                    # {{$item->id}} - {{$item->name}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-white">
                    {{$item->email}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-white">
                    {{$item->oresettimanali}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-white">
                    {{$item->oresaldo}}
                </td>
                <td class="px-6 py-4 flex ">
                    <button
                        title="elimina" @click="$dispatch('info', { id: '{{$item->id}}' })"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-pink-800">
                            <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                <svg class="w-[20px] h-[20px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                  <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                    </button>

                    <button
                        title="modifica" wire:click="modifica({{$item}})"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                            <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                <svg class="w-[20px] h-[20px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
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
            {{$listaOperatori->links(data: ['scrollTo' => false])}}
        </div>
    @endif

    <script>
        window.addEventListener('aggiungi', event => {
            Swal.fire({
                title: "Esito",
                text: event.detail[0].testo,
                icon: event.detail[0].icon,
                showConfirmButton: false,
                timer: 2000
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
                            text: "L'operatore è stato eliminato.",
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

