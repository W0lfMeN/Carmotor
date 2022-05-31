@extends('layouts.plantillaProductos')
@section('titulo')
Facturacion
@endsection
@section('tituloBody')
Rellene los datos de envio
@endsection
@section('contenido')
<div class="py-5">
    <form action="{{route('tienda.procesarCarrito')}}" method="post">
        @csrf

        <div class="py-4 px-2 w-3/4 mx-auto border-black border-2 rounded-lg">
            {{-- Nombre y apellidos --}}
            <div class="grid xl:grid-cols-2 xl:gap-6 pt-4">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if (Auth::check()) value="{{auth::user()->name}}" readonly @endif/>
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>

                    @error('name')
                            <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="apellidos" id="apellidos" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if (Auth::check()) value="{{auth::user()->apellidos}}" readonly @endif />
                    <label for="apellidos" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellidos</label>

                    @error('apellidos')
                            <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{--  --}}

            {{-- Correo electronico --}}

            <div class="relative z-0 w-full mb-6 group">
                <input type="email" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if (Auth::check()) value="{{auth::user()->email}}" readonly @endif/>
                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>

                @error('email')
                        <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}

            {{-- Direccion --}}

            <label for="" class="mb-4 text-lg">Dirección</label>

            <div class="grid xl:grid-cols-2 xl:gap-6 pt-4">
                {{-- Calle --}}
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="calle" id="calle" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if($direccion!=null) value="{{$direccion[0]}}" readonly  @endif  />
                    <label for="calle" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Calle, Nº</label>

                    @error('calle')
                        <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>
                {{--  --}}
                {{-- Codigo postal --}}
                <div class="relative z-0 w-full mb-6 group">
                    <input type="number" name="cp" id="cp" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if($direccion!=null) value={{$direccion[1]}} readonly  @endif />
                    <label for="cp" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Codigo Postal (CP)</label>

                    @error('cp')
                        <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>
                {{--  --}}
                {{-- Poblacion --}}
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="poblacion" id="poblacion" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if($direccion!=null) value="{{$direccion[2]}}" readonly  @endif />
                    <label for="poblacion" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Poblacion</label>

                    @error('poblacion')
                        <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>
                {{--  --}}
                {{-- Provincia --}}
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="provincia" id="provincia" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " @if($direccion!=null) value="{{$direccion[3]}}" readonly  @endif />
                    <label for="provincia" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Provincia</label>

                    @error('provincia')
                        <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{--  --}}

            {{-- Carrito --}}
            <label for="" class="mb-4 text-lg">Carrito</label>
            <br>
            <label for="" class="mb-4 text-lg"><b>Coste total:</b> {{Cart::session(Auth::user()->id)->getSubTotal()}} €</label>
            @foreach (Cart::session(Auth::user()->id)->getContent() as $item)
                <div class="grid grid-cols-4 border-2 rounded p-3 mt-3 bg-white border-gray-200">
                    {{-- Imagen --}}
                    <div class="col-span-4 sm:col-span-4 md:col-span-1 ">
                        <div class="overflow-hidden w-full relative rounded-lg ">
                            <img src="{{Storage::url($item->attributes['imagen'])}}" class="w-full" alt="">
                        </div>
                    </div>
                    {{--  --}}
                    {{-- Informacion --}}
                    <div class="col-span-4 sm:col-span-4 md:col-span-3 md:mx-2">
                        <h1 class="text-md">{{\Str::limit($item->name, 102)}}</h1>
                        <h2 class="text-xl font-medium pt-3">{{$item->price}} €</h2>
                        <h2 class="text-md font-medium pt-3">Cantidad: {{$item->quantity}} </h2>
                    </div>
                    {{--  --}}
                </div>
                {{--  --}}
            @endforeach

            <div class="mt-10">
                <div>
                    <button type="submit" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800"><i class="fa-brands fa-paypal"></i> Pasar al pago</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
