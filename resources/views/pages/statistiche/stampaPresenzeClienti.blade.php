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
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-2 sm:pt-0">

    <div class="w-3/4 mt-1 bg-white dark:bg-gray-100 shadow-md overflow-hidden sm:rounded-lg">
        <div class="container mx-auto">

            <div>
                <h2 class="text-center text-3xl border rounded-lg p-4 bg-blue-100">
                    Presenze {{$ragazzoConPresenzeAttivita['name']}} - {{$mese}}/{{$anno}}
                </h2>
            </div>

            <div class="bg-gray-200 p-6 text-center">
                <h2 class="text-3xl mb-2" style="margin-top: 70px">Attività Mensili</h2>

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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ragazzoConPresenzeAttivita['asociazionimensili'] as $item)
                            <tr class="text-center text-white border-b bg-gray-800 border-gray-700 hover:bg-gray-50 hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    {{$item['activity']['name']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    {{$item['activity']['tipo']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    € {{$item['activity']['cost']}}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <h2 class="text-3xl mb-2" style="margin-top: 70px">Attività Orarie</h2>

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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ragazzoConPresenzeAttivita['activities_orario'] as $item)
                            <tr class="text-center text-white border-b bg-gray-800 border-gray-700 bg-gray-50 hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    {{$item['pivot']['id']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    {{$item['name']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    {{\Carbon\Carbon::make($item['pivot']['giorno'])->format('d-m-Y')}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    {{$item['tipo']}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    € {{$item['pivot']['costo']}}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 class="text-3xl text-center" style="margin-top: 70px">Totale: € {{$saldoOriginale}}</h2>
                @if($nuovoSaldo)
                    <div class="my-8 text-3xl flex justify-between bg-gray-50 p-4 rounded-lg">
                        <div>
                            data {{$dataMod}}
                        </div>
                        <div>
                            Importo € {{$importoMod}}
                        </div>
                        <div>
                            Causale {{$causaleMod}}
                        </div>
                    </div>
                    <div class="my-8 text-3xl">
                        Nuovo Saldo: € {{$nuovoSaldo}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>




