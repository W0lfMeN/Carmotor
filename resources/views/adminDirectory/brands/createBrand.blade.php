@extends('layouts.plantillaAdmin')
@section('cabecera')
    Añadir una marca
@endsection
@section('contenido')
    <div class="bg-gray-300 rounded py-4 px-2 w-3/4 mx-auto">
        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div>
                <label for="tit" class="block text-sm font-medium text-gray-700 mb-2">Nombre de la marca</label>
                <input type="text" name="nombre" id="tit"
                    class="py-2 px-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md"
                    placeholder="Nombre" required>
                @error('nombre')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>

            <div class="mt-2">
                <label for="cont" class="block text-sm font-medium text-gray-700 mb-2">Descripcion de la marca</label>
                <textarea name="descripcion" id="cont"
                    class="px-2 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md"></textarea>
                @error('descripcion')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>

            <div class="mt-2">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-save"></i> Guardar</button>
                <a href="{{ route('brands.index') }}"
                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-backward"></i> Regresar</a>
            </div>
        </form>
    </div>
@endsection
