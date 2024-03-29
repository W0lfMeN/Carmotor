@extends('layouts.plantillaAdmin')
@section('cabecera')
    Datos del producto "{{ $userProduct->nombre }}" del usuario: {{ $userProduct->user->name }}
@endsection
@section('contenido')
    <div class="bg-gray-200 rounded py-4 my-4 px-2 w-2/4 mx-auto">
        {{-- imagen --}}
        @if ($userProduct->imagen1==null && $userProduct->imagen2==null)
            <div class="overflow-hidden relative h-48 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                <img src="{{Storage::url($userProduct->imagen)}}" class="w-full" alt="">
            </div>
        @else
            <div id="animation-carousel" class="relative" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="overflow-hidden relative h-48 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-200 ease-linear" data-carousel-item="active">
                        <img src="{{Storage::url($userProduct->imagen)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>
                    @isset($userProduct->imagen1)
                        <!-- Item 2 -->
                        <div class="hidden duration-200 ease-linear" data-carousel-item>
                            <img src="{{Storage::url($userProduct->imagen1)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                        </div>
                    @endisset
                @isset ($userProduct->imagen2)
                        <!-- Item 3 -->
                        <div class="hidden duration-200 ease-linear" data-carousel-item>
                            <img src="{{Storage::url($userProduct->imagen2)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                        </div>
                @endisset
                </div>

                <!-- Slider controls -->
                <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>
        @endif

        {{-- Nombre completo --}}
        <div class="p-5">
            <p><b>Nombre del producto: </b>{{ $userProduct->nombre }}</p>
        </div>

        {{-- Descripcion --}}
        <div class="p-5">
            <p><b>Descripcion: </b>{{ $userProduct->descripcion }}</p>
        </div>

        <div class="grid grid-cols-2 gap-3">

            {{-- Vendedor --}}
            <div class="p-5">
                <p><b>Vendedor: </b>{{ $userProduct->user->name }}</p>
            </div>

            {{-- Fecha de publicacion --}}
            <div class="p-5">
                <p><b>Fecha de venta: </b>{{ \Carbon\Carbon::parse($userProduct->fecha_venta)->format('d-m-Y') }}</p>
            </div>

            {{-- Precio --}}
            <div class="p-5">
                <p><b>Precio: </b>{{ $userProduct->precio }} €</p>
            </div>

            {{-- KMS --}}
            <div class="p-5">
                <p><b>Kilometraje: </b>{{ $userProduct->kms }} Km</p>
            </div>

            {{-- Pieza --}}
            <div class="p-5">
                <p><b>Pieza: </b>{{ $userProduct->tipo }}</p>
            </div>

        </div>

        {{-- Volver a index --}}
        <div class="p-5">
            <a href="{{ route('userProducts.index') }}"
            class="bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"><i
                    class="fas fa-backward"></i> Regresar</a>
        </div>
    </div>
    @endsection
