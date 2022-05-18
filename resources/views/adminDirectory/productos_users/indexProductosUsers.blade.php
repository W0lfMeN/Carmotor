@extends('layouts.plantillaAdmin')
@section('cabecera')
Listado de Productos
@endsection
@section('contenido')
<div class="w-3/4 mx-auto px-2 mt-2">

    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (session('mensaje'))
        <x-alertainfo>
            {{ session('mensaje') }}
        </x-alertainfo>
    @endif

    <x-estructuraTabla>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col">@sortablelink('id', 'ID')</i>
                    </th>
                    <th scope="col">@sortablelink('user_id', 'Nombre del vendedor')</i>
                    </th>
                    <th scope="col">@sortablelink('nombre', 'Nombre')</i>
                    </th>
                    <th scope="col">@sortablelink('fecha_venta', 'Fecha de venta')</i>
                    </th>
                    <th scope="col">@sortablelink('precio', 'Precio')</i>
                    </th>
                    <th scope="col">@sortablelink('kms', 'KMS')</i>
                    </th>
                    <th scope="col">@sortablelink('tipo', 'Tipo')</i>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs uppercase tracking-wider">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productosUser as $producto)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('products.show', $producto) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-info fa-xs"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="#"
                                class="text-gray-900 py-2 px-4 rounded">
                                {{$producto->user->name}}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ Storage::url($producto->imagen) }}" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ $producto->nombre }}
                                    </div>

                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($producto->fecha_venta)->format('d - M - Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $producto->precio }}&nbsp;€
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $producto->kms }} KM
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $producto->tipo }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                            <form action="{{ route('userProducts.destroy', $producto) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button onclick='return confirmar(this.form, "producto de {{$producto->user->name}}")' id="submitBtn" name="submitBtn"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-estructuraTabla>
    <div class="mt-2 mb-10">
        {{ $productosUser->links() }}
    </div>
</div>
@endsection
