<x-layouts.stile>
    <x-slot:title>{{$title}}</x-slot:title>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg min-h-screen">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 mb-4">
                <thead class="text-xs uppercase bg-gray-700 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Data
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Operatore
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Testo
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listaLogPaginate as $item)
                        <tr class="bg-gray-800 hover:bg-gray-600">
                            <td class="px-6 py-4 whitespace-nowrap text-white">
                                {{$item->created_at->format('d-m-Y - H:i')}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">
                                {{$item->tipo}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">
                                {{$item->user->name}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">
                                {{$item->data}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{$listaLogPaginate->links()}}
            </div>

</x-layouts.stile>
