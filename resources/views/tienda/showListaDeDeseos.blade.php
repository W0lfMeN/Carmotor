@extends('layouts.plantillaProductos')
@section('titulo')
Lista de deseos
@endsection
@section('contenido')
<div class="px-4 sm:px-6 lg:px-20 lg:py-20">

    <div class="grid grid-cols-12 gap-4">
       @foreach (Auth::user()->products as $producto)
            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-3 border-4 rounded p-3 mt-3 bg-white border-gray-200">
                <div class="grid grid-cols-12 gap-4 lg:mb-3">
                    {{-- Imagen --}}
                    <div class="col-span-12 sm:col-span-12 md:col-span-6">
                        <div class="overflow-hidden relative rounded-lg ">
                            <img src="{{Storage::url($producto->imagen)}}" class="w-full" alt="">
                        </div>
                    </div>
                    {{--  --}}
                    {{-- Informacion --}}
                    <div class="col-span-12 sm:col-span-12 md:col-span-6">
                        <h1 class="text-md">{{\Str::limit($producto->nombre, 102)}}</h1>
                        <h2 class="text-xl font-medium pt-3">{{$producto->precio}} €</h2>
                    </div>
                    {{--  --}}

                </div>
                <hr>
                <div class="grid grid-cols-12 gap-4 lg:mb-5">

                    <a href="{{route('tienda.addDeseo', $producto)}}" class="col-span-12 md:col-span-6  lg:col-span-3 lg:pt-3 text-xl border-2 rounded mt-3 text-center text-gray-500 transition ease-in-out duration-700 hover:bg-red-500 hover:text-white focus:ring-2 focus:outline-none focus:ring-red-500">
                        @if ($producto->users->contains(Auth::user()->id))
                            <i class="fa-solid fa-heart-circle-minus"></i>
                        @else
                            <i class="fa-solid fa-heart"></i>
                        @endif

                    </a>

                    <a href="{{route('tienda.comprarProducto', $producto)}}" class="col-span-12 md:col-span-6  lg:col-span-3 lg:pt-3 text-xl border-2 rounded mt-3 text-center text-gray-500 transition ease-in-out duration-700 hover:bg-green-500 hover:text-white focus:ring-2 focus:outline-none focus:ring-green-500">
                        <i class="fa-solid fa-credit-card"></i>
                    </a>

                    <a href="{{route('tienda.producto', $producto)}}" class="col-span-12 md:col-span-12 lg:col-span-6 text-lg border-2 border-blue-300 rounded p-3 mt-3 text-center bg-blue-500 transition ease-in-out duration-500 hover:bg-blue-700 focus:ring-2 focus:outline-none focus:ring-blue-300 text-white">
                        Visualizar
                    </a>

                </div>
            </div>
       @endforeach
    </div>

</div>
@endsection
