<div>
    @if($visualizza)
        @if($visualizzaModificheSaldo)
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 my-10">
                <thead class="text-xs uppercase bg-green-900 text-white">
                <tr class="text-center">
                    <th scope="col" class="px-6 py-3">
                        data: {{$dataModifica}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        importo: € {{$importoModifica}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        causale: {{$causaleModifica}}
                    </th>
                </tr>
                </thead>
            </table>
            <div>
                <h2 class="text-3xl text-white text-center" style="margin-top: 70px">Nuovo saldo: € {{$nuovoSaldo}}</h2>
            </div>
            <form action="{{route('statistiche.stampaPresenzeClienti')}}" method="post" target="_blank">
                @csrf
                <input type="hidden" name="saldoOriginale" value="{{$saldoOriginale}}">
                <input type="hidden" name="nuovoSaldo" value="{{$nuovoSaldo}}">
                <input type="hidden" name="ragazzoConPresenzeAttivita" value="{{json_encode($ragazzoConPresenzeAttivita)}}">
                <input type="hidden" name="anno" value="{{$anno}}">
                <input type="hidden" name="mese" value="{{$mese}}">
                <input type="hidden" name="causaleMod" value="{{$causaleModifica}}">
                <input type="hidden" name="importoMod" value="{{$importoModifica}}">
                <input type="hidden" name="dataMod" value="{{$dataModifica}}">
                <button type="submit"
                        class="flex text-white mx-3 bg-yellow-600 hover:bg-yellow-500 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                    Stampa
                </button>
            </form>
        @else
            <div class="grid gap-6 my-10 md:grid-cols-5">
                <div>
                    <label for="giorno" class="text-white p-2 lg:hidden">Seleziona giorno:</label>
                    <input wire:model="dataModifica"
                           type="date"
                           id="giorno"
                           class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"/>
                </div>
                <div>
                    <input wire:model="importoModifica"
                           type="number"
                           class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                           placeholder="importo"/>
                </div>
                <div>
                    <input wire:model="causaleModifica"
                           type="text"
                           class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                           placeholder="causale"/>
                </div>
                <div class="flex">
                    <button wire:click="modificaSaldo"
                            class="flex text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                        Modifica
                    </button>

                    <form action="{{route('statistiche.stampaPresenzeClienti')}}" method="post" target="_blank">
                        @csrf
                        <input type="hidden" name="saldoOriginale" value="{{$saldoOriginale}}">
                        <input type="hidden" name="nuovoSaldo" value="{{$nuovoSaldo}}">
                        <input type="hidden" name="ragazzoConPresenzeAttivita" value="{{json_encode($ragazzoConPresenzeAttivita)}}">
                        <input type="hidden" name="anno" value="{{$anno}}">
                        <input type="hidden" name="mese" value="{{$mese}}">
                        <button type="submit"
                            class="flex text-white mx-3 bg-yellow-600 hover:bg-yellow-500 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                            Stampa
                        </button>
                    </form>

                </div>
            </div>
        @endif
    @endif
</div>
