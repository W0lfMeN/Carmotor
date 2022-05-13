<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CarMotor.es') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        {{-- Font awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('css/cssPersonal.css')}}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{asset('js/javascriptPersonal.js')}}"></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen">
            @livewire('navigation-menu')

                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 text-red-500 sm:px-6 lg:px-8">
                        <div class="flex">
                            <a href="#" class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                                {{ __('Products') }}
                            </a>
                            <a href="{{route('brands.index')}}" class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                                {{ __('Brands') }}
                            </a>
                            <a href="#" class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                                {{ __('UserProducts') }}
                            </a>
                            <a href="{{route('users.index')}}" class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                                {{ __('Users') }}
                            </a>
                        </div>
                    </div>
                </header>

            <!-- Page Content -->
            <div class="text-center mt-4 text-2xl text-gray-800">@yield('cabecera')</div>
            <main>
                @yield('contenido')
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
