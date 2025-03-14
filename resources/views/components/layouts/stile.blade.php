<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Arkadia Onlus' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />

    <style>
        .swal2-styled.swal2-confirm {
            background: #68ad68 !important;
        }
        .swal2-styled.swal2-confirm:hover {
            background: #37ab37 !important;
        }
        .swal2-styled.swal2-cancel {
            background: #fc5757 !important;
        }
        .swal2-styled.swal2-cancel:hover {
            background: red !important;
        }
    </style>

    @livewireStyles
</head>
<body class="font-sans antialiased bg-black text-white/50">
<div class="text-black/50 bg-black text-white/50">
    <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

            <header class="grid grid-cols-4 items-center gap-2 py-8 lg:grid-cols-12">
                <div class="lg:col-span-3">
                    <a href="{{route('inizio')}}">
                        <svg class="w-10 h-10 text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <div class="flex lg:justify-center lg:col-span-6 hidden lg:flex">
                    <h2 class="text-white text-3xl">{{ $title ?? 'Arkadia Onlus' }}</h2>
                </div>
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end col-span-3">
                        @auth
                            <select id="mySelect" onchange="handleSelectChange(this)" class="border text-sm rounded-lg block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                                <option selected>{{ Auth::user()->name }}</option>
                                <option value="option1" data-url="{{route('logout')}}">Logout</option>
                            </select>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none text-white hover:text-white/80 focus-visible:ring-white"
                            >
                                Log in
                            </a>
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="mt-6">
                {{ $slot }}
            </main>

            <footer class="py-16 text-center text-sm text-white/70">
                @ ColtriCat - 2018
            </footer>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@show

<script>
    function handleSelectChange(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const url = selectedOption.getAttribute('data-url'); // URL specifico per l'opzione
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (url) {
            // Invia la richiesta POST
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
            })
            .then(response => {
                location.reload()
            })
        }
    }

</script>
@livewireScripts
</body>
</html>
