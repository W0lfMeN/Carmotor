@extends('layouts.plantillaAdmin')
@section('cabecera')
    Añadir una marca
@endsection
@section('contenido')
    <div class="rounded py-4 px-2 w-3/4 mx-auto">
        <form action="{{ route('brands.store')}}" method="POST">
            @csrf
            <div class="py-4 px-2 w-3/4 mx-auto border-black border-2 rounded-lg">

                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="nombre" id="nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                    <label for="nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre de la marca</label>

                    @error('nombre')
                            <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripcion (opcional)</label>
                    <textarea id="descripcion" name="descripcion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "></textarea>

                    @error('descripcion')
                            <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-10">
                    <button type="submit" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-save"></i> Crear</button>
                    <a href="{{ route('brands.index') }}" class="bg-orange-500 hover:bg-orange-700 mx-4 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white"><i class="fas fa-backward"></i> Regresar</a>
                </div>

            </div>
        </form>
    </div>
@endsection
