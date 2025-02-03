<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="flex flex-col sm:justify-center items-center">

    <div class="w-3/4 mt-1 bg-white overflow-hidden sm:rounded-lg">
        <div class="container mx-auto">

            <div>
                <h2 class="text-center text-2xl border border-gray-700 p-2">
                    Presenze {{$ragazzoConPresenzeAttivita['name']}} - {{$mese}}/{{$anno}}
                </h2>
            </div>

            <div class="p-6 text-center">
                <h2 class="text-2xl mb-2" style="margin-top: 10px">Attività Mensili</h2>

                <div class="relative overflow-x-auto ">
                    <table class="w-full text-sm text-left rtl:text-right mb-4">
                        <thead class="text-xs uppercase border border-gray-700 bg-blue-100">
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ragazzoConPresenzeAttivita['asociazionimensili'] as $item)
                            <tr class="text-center border border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{$item['activity']['name']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{$item['activity']['tipo']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    € {{$item['activity']['cost']}}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <h2 class="text-2xl mb-2" style="margin-top: 30px">Attività Orarie</h2>

                <div class="relative overflow-x-aut sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right mb-4">
                        <thead class="text-xs uppercase border border-gray-700 bg-blue-100">
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ragazzoConPresenzeAttivita['activities_orario'] as $item)
                            <tr class="text-center border border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowra">
                                    {{$item['pivot']['id']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{$item['name']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{\Carbon\Carbon::make($item['pivot']['giorno'])->format('d-m-Y')}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{$item['tipo']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    € {{$item['pivot']['costo']}}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 class="text-xl text-center border border-gray-700 p-2" style="margin-top: 40px;">
                    Totale: € {{$saldoOriginale}}
                </h2>

                @if($nuovoSaldo)
                    <h2 class="text-xl text-center border border-gray-700 p-2" style="margin-top: 40px;">
                        Modifiche
                    </h2>
                    <table class="w-full text-sm text-left rtl:text-right mb-4">
                        <thead class="text-xs uppercase border border-gray-700 bg-blue-100">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                data
                            </th>
                            <th scope="col" class="px-6 py-3">
                                importo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                causale
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0; $i<count($importoMod); $i++)
                            <tr class="text-center border border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowra">

                                    {{\Carbon\Carbon::make($dataMod[$i])->format('d-m-Y')}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                   € {{$importoMod[$i]}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{$causaleMod[$i]}}
                                </th>
                            </tr>
                        @endfor
                        </tbody>
                    </table>

{{--                    @for($i=0; $i<count($importoMod); $i++)
                    <div class="my-8 text-2xl flex justify-between bg-gray-50 p-4 border border-gray-700">
                        <div>
                            data {{$dataMod[$i]}}
                        </div>
                        <div>
                            Importo € {{$importoMod[$i]}}
                        </div>
                        <div>
                            Causale {{$causaleMod[$i]}}
                        </div>
                    </div>
                    @endfor--}}

                    <div class="my-8 text-xl border border-gray-700 p-2">
                        Nuovo Saldo: € {{$nuovoSaldo}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>




