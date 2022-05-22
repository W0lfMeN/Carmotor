@extends('layouts.plantillaContacto')
@section('cabecera')
Formulario de contacto
@endsection
@section('contenido')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('contacto.procesar')}}" method="POST">
                @csrf
                <div class="py-4 px-2 w-3/4 mx-auto border-black border-2 rounded-lg">
                    {{-- Nombre y apellidos --}}

                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="nombre" id="nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if (Auth::check()) value="{{auth::user()->name}}" readonly @endif />
                        <label for="nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>

                        @error('nombre')
                                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                        @enderror
                    </div>
                    {{--  --}}

                    {{-- Correo electronico --}}

                    <div class="relative z-0 w-full mb-6 group">
                        <input type="email" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if (Auth::check()) value="{{auth::user()->email}}" readonly @endif />
                        <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>

                        @error('email')
                                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <label for="mensaje" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Indicanos el motivo de tu consulta</label>
                        <textarea id="mensaje" name="mensaje" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                        @error('mensaje')
                                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-10">
                        <button type="submit" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800"><i class="fas fa-paper-plane"></i> Enviar</button>
                        <a href="{{ route('index') }}" class="bg-orange-500 hover:bg-orange-700 mx-4 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"><i class="fas fa-backward"></i> Regresar</a>
                    </div>
                </div>

            </form>
    </div>
</div>
@endsection
