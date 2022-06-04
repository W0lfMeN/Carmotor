@extends('layouts.plantillaAdmin')
@section('cabecera')
Listado de Marcas
@endsection
@section('contenido')
<div class="w-11/12 mx-auto px-2 mt-2">

    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (session('mensaje'))
        <x-alertaInfo>
            {{ session('mensaje') }}
        </x-alertaInfo>
    @endif

    <div class="my-4">
        <a href="{{ route('brands.create') }}" class="bg-blue-500 font-bold hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white">
            <i class="fas fa-plus"></i> Crear Marca</a>
    </div>

    @if(count($brands)==0)
        <x-alertaInfo>No hay registros de marcas.</x-alertaInfo>
    @else

        <x-estructuraTabla>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col">@sortablelink('id', 'ID')</th>

                        <th scope="col">@sortablelink('nombre', 'Nombre')</i>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs text-black uppercase tracking-wider">
                            Descripcion
                        </th>
                        <th scope="col" colspan="2" class="px-6 py-3 text-center text-xs text-black uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($brands as $brand)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p href="{{ route('brands.show', $brand) }}"
                                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                                    {{$brand->id}}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $brand->nombre }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($brand->descripcion==null)
                                    <b>Descripcion no proporcionada</b>
                                @else
                                    {{ $brand->descripcion }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{ route('brands.edit', $brand) }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-edit"></i></a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('brands.destroy', $brand) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button onclick='return confirmar(this.form, "la marca {{$brand->nombre}}")' id="submitBtn" name="submitBtn"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        <i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-estructuraTabla>
    @endif

    <div class="mt-2">
        {{ $brands->links() }}
    </div>

</div>
@endsection
