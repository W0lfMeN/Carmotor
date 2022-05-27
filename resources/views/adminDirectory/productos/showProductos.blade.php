@extends('layouts.plantillaAdmin')
@section('cabecera')
    Datos del producto "{{ $product->nombre }}"
@endsection
@section('contenido')
    <div class="bg-gray-200 rounded py-4 my-4 px-2 w-2/4 mx-auto">
        {{-- imagen --}}
        @if ($product->imagen1==null && $product->imagen2==null)
            <div class="overflow-hidden relative h-48 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                <img src="{{Storage::url($product->imagen)}}" class="w-full" alt="">
            </div>
        @else
        <div id="default-carousel" class="relative" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800"></span>
                    <img src="{{Storage::url($product->imagen)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                </div>

                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{Storage::url($product->imagen1)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                </div>

                @if($product->imagen2)
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{Storage::url($product->imagen2)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>

                @else
                    <!-- Item 1 copia -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800"></span>
                        <img src="{{Storage::url($product->imagen)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>

                    <!-- Item 2 copia -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{Storage::url($product->imagen1)}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>
                @endif


            </div>
            <!-- Slider indicators -->
            {{-- <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                @isset($product->imagen2) <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button> @endisset

            </div> --}}
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
            <p><b>Nombre del producto: </b>{{ $product->nombre }}</p>
        </div>

        {{-- Descripcion --}}
        <div class="p-5">
            <p><b>Descripcion: </b>{{ $product->descripcion }}</p>
        </div>

        <div class="grid grid-cols-2 gap-3">

            {{-- Fecha de publicacion --}}
            <div class="p-5">
                <p><b>Fecha de venta: </b>{{ \Carbon\Carbon::parse($product->fecha_venta)->format('d-m-Y') }}</p>
            </div>

            {{-- Precio --}}
            <div class="p-5">
                <p><b>Precio: </b>{{ $product->precio }} €</p>
            </div>

            {{-- Cantidad --}}
            <div class="p-5">
                <p><b>Unidades disponibles: </b><span @if ($product->cantidad <=3) class="text-red-500" @endif>
                        @if ($product->cantidad === 0)
                            AGOTADO
                        @else
                            {{ $product->cantidad }}
                        @endif
                    </span>
                </p>
            </div>

            {{-- Pieza --}}
            <div class="p-5">
                <p><b>Pieza: </b>{{ $product->tipo }}</p>
            </div>

        </div>

        {{--  Bucle de marcas --}}
        <div class="px-6 pt-4 pb-2">
            @foreach ($product->brands as $brand)
                <span class="inline-block bg-gray-500 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2 mt-1">{{$brand->nombre}}</span>
            @endforeach
        </div>

        {{-- Volver a index --}}
        <div class="p-5">
            <a href="{{ route('products.index') }}"
            class="bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white">
                    <i class="fas fa-backward"></i> Regresar</a>
        </div>
    </div>
    @endsection
