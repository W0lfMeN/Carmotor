{{-- Plantilla que usaré para casi toda la web --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('titulo')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        {{-- Font awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Tailwind CDN --}}
        <script src="https://cdn.tailwindcss.com"></script>

        {{-- Jquery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        {{-- Sweet alert --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.5/dist/flowbite.min.css" />

        <link rel="icon" href="{{ url('storage/resources/Logo.jpeg') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('css/cssPersonal.css')}}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>

        <script src="{{ mix('js/app.js') }}" defer></script>
        <!-- Cargo mi js personal y llamo con onload a cargar los listeners que tengo definidos -->
        <script type="text/javascript" src="{{asset('js/javascriptPersonal.js')}}"></script>
        <script>window.onload=listeners</script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen">
            @livewire('navigation-menu')

            @hasSection('cabecera')
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 text-red-500 sm:px-6 lg:px-8">
                        @yield('cabecera')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('contenido')
            </main>

            <x-footer />
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
