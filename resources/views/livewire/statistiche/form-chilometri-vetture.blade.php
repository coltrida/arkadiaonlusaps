<div>
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
            @if($isLoading)
                <svg aria-hidden="true" class="w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
            @else
            <button wire:click="visualizza"
                    @disabled($isLoading)
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Visualizza
            </button>
            @endif
        </div>
    </div>
</div>
