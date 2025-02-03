<div>
    @if($visualizza)
        @if($visualizzaModificheSaldo)
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 my-10">
                <thead class="text-xs uppercase bg-green-900 text-white">
                @for($i=0; $i<count($importoModifica); $i++)
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            data: {{$dataModifica[$i]}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            importo: € {{$importoModifica[$i]}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            causale: {{$causaleModifica[$i]}}
                        </th>
                    </tr>
                @endfor
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
                @foreach($causaleModifica as $causale)
                    <input type="hidden" name="causaleMod[]" value="{{ $causale }}">
                @endforeach

                @foreach($importoModifica as $importo)
                    <input type="hidden" name="importoMod[]" value="{{ $importo }}">
                @endforeach

                @foreach($dataModifica as $data)
                    <input type="hidden" name="dataMod[]" value="{{ $data }}">
                @endforeach

                <button type="submit"
                        class="flex text-white mx-3 bg-yellow-600 hover:bg-yellow-500 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                    Stampa
                </button>
            </form>
        @else
            @for($i = 0; $i<$nrModifiche; $i++)
            <div class="grid gap-6 my-10 md:grid-cols-5">
                <div>
                    <label for="giorno" class="text-white p-2 lg:hidden">Seleziona giorno:</label>
                    <input wire:model="dataModifica.{{$i}}"
                           type="date"
                           id="giorno"
                           class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"/>
                </div>
                <div>
                    <input wire:model="importoModifica.{{$i}}"
                           type="number"
                           class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                           placeholder="importo"/>
                </div>
                <div>
                    <input wire:model="causaleModifica.{{$i}}"
                           type="text"
                           class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                           placeholder="causale"/>
                </div>

            </div>
            @endfor


            <div class="flex">
                <button wire:click="modificaSaldo"
                        class="flex text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                    esegui Modifica
                </button>

                <button wire:click="inserisciModifica"
                        class="flex mx-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                    Aggiungi modifica
                </button>

                <form action="{{route('statistiche.stampaPresenzeClienti')}}" method="post" target="_blank">
                    @csrf
                    <input type="hidden" name="saldoOriginale" value="{{$saldoOriginale}}">
                    <input type="hidden" name="nuovoSaldo" value="{{$nuovoSaldo}}">
                    <input type="hidden" name="ragazzoConPresenzeAttivita" value="{{json_encode($ragazzoConPresenzeAttivita)}}">
                    <input type="hidden" name="anno" value="{{$anno}}">
                    <input type="hidden" name="mese" value="{{$mese}}">
                    <button type="submit"
                            class="flex text-white bg-yellow-600 hover:bg-yellow-500 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                        Stampa
                    </button>
                </form>
            </div>
        @endif
    @endif
</div>
