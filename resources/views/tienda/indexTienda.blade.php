@extends('layouts.plantillaProductos')
@section('titulo')
    Carmotor.es
@endsection
@section('contenido')
    <div class="py-10">
        <div class="sm:px-6 md:mx-14 lg:px-8 lg:mx-28">
            <form name="bus" action="{{ route('tienda') }}" method="get">
            {{-- Aqui mostramos el aside --}}
            <div class="grid grid-cols-12 gap-2 mx-3 sm:mx-1">
                {{-- Div del aside --}}
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-3 my-10">
                    <aside class="w-36 sm:w-64" aria-label="Sidebar">
                        <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded">
                            <ul class="space-y-2">
                                {{--  --}}
                                <li>
                                    <h2 class="text-center text-xl">Precio</h2>
                                </li>

                                <li>
                                    <input id="radioPrecio" type="radio" value="1" name="radioPrecio" @if ($request->radioPrecio==1) checked @endif
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                    <label for="radioPrecio"
                                        class="ml-2 text-sm font-medium text-gray-900">Menor a
                                        mayor</label>
                                </li>
                                <li>
                                    <input id="radioPrecio" type="radio" value="2" name="radioPrecio" @if ($request->radioPrecio==2) checked @endif
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="radioPrecio"
                                        class="ml-2 text-sm font-medium text-gray-900">Mayor a
                                        menor</label>
                                </li>
                            </ul>
                            {{-- Fin precio --}}

                            {{-- Piezas --}}
                            <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200">
                                <li>
                                    <h2 class="text-center text-xl">Pieza</h2>
                                </li>
                                @foreach ($tipos as $tipo)
                                    <li>
                                        <input id="radioTipos" type="radio" value="{{ $tipo }}" name="radioTipos" @if ($request->radioTipos==$tipo) checked @endif
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                        <label for="radioTipos"
                                            class="ml-2 text-sm font-medium text-gray-900 ">{{ $tipo }}</label>
                                    </li>
                                @endforeach

                            </ul>
                            {{-- Fin Piezas--}}

                            {{-- Marcas --}}
                            <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200">
                                {{--  --}}
                                <li>
                                    <h2 class="text-center text-xl">Marcas</h2>
                                </li>
                                @foreach ($marcas as $marca)
                                    <li>
                                        <input id="radioMarcas" type="radio" value="{{ $marca->id }}"
                                            name="radioMarcas" @if ($request->radioMarcas==$marca->id) checked @endif
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                        <label for="radioMarcas"
                                            class="ml-2 text-sm font-medium text-gray-900 ">{{ $marca->nombre }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            {{-- Fin Marcas --}}
                        </div>
                    </aside>
                </div>
                {{-- Div que cierra el side --}}

                <div class="col-span-6 sm:col-span-6 md:col-span-8 lg:col-span-9 my-8">
                    <div class="flex my-4">
                        <div class="w-full">
                            <input type="search" name="nombre" placeholder="Buscar un producto..." value="{{$request->nombre}}"
                                class="py-2 px-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md" />
                        </div>
                        <div class="ml-4">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 my-10">
                        @foreach ($productos as $producto)
                            {{--  --}}
                            <a href="{{route('tienda.producto', $producto)}}" class="rounded overflow-hidden @if($loop->iteration/4 <=1) mb-5 @else mb-10 @endif shadow-lg hover:shadow-2xl transform transition duration-500 hover:scale-110 ease-in-out">
                                <img loading="lazy" class="w-full" src="{{Storage::url($producto->imagen)}}" alt="{{$producto->nombre}}">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{$producto->nombre}}</div>
                                    <p class="font-bold text-xl text-center">
                                        {{$producto->precio}}&nbsp;€
                                    </p>
                                </div>
                                <div class="px-2 mt-2 font-bold items-center">
                                    {{$producto->tipo}}
                                </div>

                                @if ($producto->cantidad <= 3)
                                    <div class="px-2 my-2 font-bold text-red-800 items-center">
                                        <h5>Solo quedan {{$producto->cantidad}} en stock!!</h5>
                                    </div>
                                @endif

                                <div class="px-6 pt-4 pb-2">
                                    @foreach ($producto->brands as $brand)
                                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 mt-1">{{$brand->nombre}}</span>
                                    @endforeach
                                </div>
                            </a>
                            {{--  --}}
                        @endforeach
                    </div>
                    <div class="mt-2 mb-10">
                        {{ $productos->links() }}
                    </div>

                </div>

            </div>
            {{-- Div que cierra el grid --}}
        </form>

        </div>
    </div>
@endsection
