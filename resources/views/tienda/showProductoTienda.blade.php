@extends('layouts.plantillaProductos')
@section('titulo')
    {{$product->nombre}}
@endsection
@section('contenido')
<div class="px-4 sm:px-6 lg:px-20 lg:py-20">
    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (session('deseo'))
        <x-alertaInfoBonita>
            {{ session('deseo') }}
        </x-alertaInfoBonita>
    @endif

    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (session('carrito'))
        <x-alertaInfoVerde>
            {{ session('carrito') }}
        </x-alertaInfoVerde>
    @endif

    <div class="border-4 rounded p-3 mt-3 bg-white border-gray-200">
        <div class="container">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-4 pl-0">

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
                                    <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
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
                                        <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
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

                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-8">
                    <h1 class="text-3xl font-medium">{{$product->nombre}}</h1>
                    <h2 class="text-4xl font-medium pt-5">{{$product->precio}} €</h2>


                    <div class="grid grid-cols-12 gap-4">

                        <a href="{{route('tienda.addDeseo', $product)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" @if (Auth::check() && $product->users->contains(Auth::user()->id)) title="Eliminar de la lista de deseos" @else title="Añadir de la lista de deseos" @endif class="col-span-12 md:col-span-6 md:pt-6 lg:col-span-1 lg:pt-3 text-xl border-2 rounded mt-3 text-center text-gray-500 transition ease-in-out duration-700 @if (Auth::check() && $product->users->contains(Auth::user()->id)) hover:bg-red-500 focus:ring-red-500 @else hover:bg-green-500 focus:ring-green-500 @endif hover:text-white focus:ring-2 focus:outline-none">
                            @if (Auth::check() && $product->users->contains(Auth::user()->id))
                                <i class="fa-solid fa-heart-circle-check"></i>
                            @else
                                <i class="fa-solid fa-heart"></i>
                            @endif

                        </a>

                        <a href="{{route('tienda.addCarrito', $product)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Añadir al carrito" class="col-span-12 md:col-span-6 lg:col-span-5 text-xl border-2 rounded p-3 mt-3 text-center text-gray-500 transition ease-in-out duration-700 hover:text-green-500 focus:ring-2 focus:outline-none focus:ring-green-500">
                            <i class="fa-solid fa-cart-plus"></i> Añadir al carrito
                        </a>

                        <a href="{{route('tienda.comprarProducto', $product)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comprar Producto" class="col-span-12 md:col-span-12 lg:col-span-6 text-xl border-2 border-blue-300 rounded p-3 mt-3 text-center bg-blue-500 transition ease-in-out duration-500 hover:bg-blue-700 focus:ring-2 focus:outline-none focus:ring-blue-300 text-white">
                            Comprar
                        </a>

                    </div>

                    <div class="mt-5">
                        <p class="text-xl mb-1">Compatible con las siguientes marcas</p>
                        @foreach ($product->brands as $brand)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 mt-1">{{$brand->nombre}}</span>
                        @endforeach
                    </div>

                    <h2 class="text-2xl font-medium pt-5">Año de fabricación: {{\Carbon\Carbon::parse($product->fecha_venta)->format('Y') }}</h2>


                </div>

            </div>
            <div class="mt-3">
                <h2 class="text-xl font-medium pt-5">Descripcion del producto.</h2>
                <p class="mt-2">{{$product->descripcion}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
