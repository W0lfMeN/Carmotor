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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    {{-- Sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.5/dist/flowbite.min.css" />

    <link rel="icon" href="{{ url('storage/resources/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssPersonal.css') }}">



    @livewireStyles

    <!-- Scripts -->
    <script src="https://unpkg.com/flowbite@1.4.6/dist/datepicker.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/javascriptPersonal.js') }}"></script>
    <script>window.onload=listenersAdmin</script>

</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen">
        @livewire('navigation-menu')

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex">
                    <a href="{{route('products.index')}}" class="font-semibold text-xl text-center text-gray-800 leading-tight flex mx-10">
                        {{ __('Productos') }}
                    </a>
                    <a href="{{ route('brands.index') }}"
                        class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                        {{ __('Marcas') }}
                    </a>
                    {{-- <a href="{{route('userProducts.index')}}" class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                        {{ __('Tienda de segunda mano') }}
                    </a> --}}
                    <a href="{{ route('users.index') }}"
                        class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                        {{ __('Usuarios') }}
                    </a>
                    <a href="{{ route('facturas.index') }}"
                        class="font-semibold text-xl text-gray-800 leading-tight flex mx-10">
                        {{ __('Facturas') }}
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
    {{-- <script>

        /* Funcion que usa el sweet alert para preguntar si desea de verdad borrar el usuario o no */
        function confirmar(formulario, mensaje){
            event.preventDefault();

            Swal.fire({
                title: '¿Seguro que desea borrar este '+mensaje+" ?",
                text: "Esta acción no se puede deshacer",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Borrar '+mensaje,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    formulario.submit(); /* Si se pulsa "si", se enviará el formulario que se le haya pasado, borrando el usuario seleccionado */
                }
            })
        }

        function error(mensaje){
            Swal.fire(
                'Error',
                mensaje,
                'error'
            )
        }



    </script> --}}
</body>

</html>
