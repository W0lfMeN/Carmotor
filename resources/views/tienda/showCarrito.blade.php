@extends('layouts.plantillaProductos')
@section('titulo')
Carrito
@endsection
@section('contenido')
<div class="px-4 sm:px-6 lg:px-20 lg:py-20">

    <div class="grid grid-cols-2 gap-4">
        <div class="border-4 rounded p-3 mt-3 bg-white border-gray-200">

            {{-- Div del bloque --}}
            @foreach (Cart::session(Auth::user()->id)->getContent() as $item)
                 <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-3 border-4 rounded p-3 mt-3 bg-white border-gray-200">
                     <div class="grid grid-cols-12 gap-4 lg:mb-3">
                         {{-- Imagen --}}
                         <div class="col-span-12 sm:col-span-12 md:col-span-6">
                             <div class="overflow-hidden relative rounded-lg  ">
                                 <img src="{{Storage::url($item->attributes['imagen'])}}" class="w-4/5" alt="">
                             </div>
                         </div>
                         {{--  --}}
                         {{-- Informacion --}}
                         <div class="col-span-12 sm:col-span-12 md:col-span-6">
                             <h1 class="text-md">{{\Str::limit($item->name, 102)}}</h1>
                             <h2 class="text-xl font-medium pt-3">{{$item->price}} €</h2>
                             <h2 class="text-md font-medium pt-3">Cantidad: {{$item->quantity}} </h2>

                            <div class="pt-5 place-items-end">
                                <a href="{{route('carrito.borrar', $item->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar del carrito" class="col-span-12 md:col-span-6 lg:col-span-6 text-xl border-1 border-red-300 rounded p-3 mt-3 bg-red-500 transition ease-in-out duration-500 hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300 text-white" ><i class="fa-solid fa-trash"></i></a>

                            </div>
                         </div>
                         {{--  --}}
                    </div>
                     <hr>

                 </div>
            @endforeach

        </div>

        <div class="border-4 rounded p-3 mt-3 bg-white border-gray-200 ">
            <div class="border-4 rounded p-3 mt-3 bg-white border-gray-200">
                <div class="">
                    <h2><b>Coste total:</b> {{Cart::session(Auth::user()->id)->getSubTotal()}} €</h2>
                </div>

            </div>

            <div class="p-3 mt-3 grid grid-cols-12 gap-4">

                    <a href="{{route('tienda.comprarCarrito')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comprar Producto" class="@if (Cart::session(Auth::user()->id)->isEmpty()) pointer-events-none @endif col-span-12 md:col-span-6 lg:col-span-6 text-xl border-2 border-blue-300 rounded p-3 mt-3 text-center bg-blue-500 transition ease-in-out duration-500 hover:bg-blue-700 focus:ring-2 focus:outline-none focus:ring-blue-300 text-white">
                        Comprar
                    </a>

                    <a href="{{route('carrito.limpiar')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Limpiar carrito" class="@if (Cart::session(Auth::user()->id)->isEmpty()) pointer-events-none @endif col-span-12 md:col-span-6 lg:col-span-6 text-xl border-2 border-red-300 rounded p-3 mt-3 text-center bg-red-500 transition ease-in-out duration-500 hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300 text-white" >
                        Limpiar
                    </a>

            </div>
        </div>

    </div>



</div>
@endsection


<!--

        -->
