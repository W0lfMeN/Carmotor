@extends('layouts.plantillaAdmin')
@section('cabecera')
Listado de Productos
@endsection
@section('contenido')
<div class="w-11/12 mx-auto px-2 mt-2">

    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (session('mensaje'))
        <x-alertainfo>
            {{ session('mensaje') }}
        </x-alertainfo>
    @endif

    <div class="my-4">
        <a href="{{ route('products.create') }}" class="bg-blue-500 font-bold hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800 text-white">
            <i class="fas fa-plus"></i> Añadir un producto</a>
    </div>

    <form name="bus" action="{{ route('products.index') }}" method="get">
        <div class="flex my-4">

                <div class="w-11/12">
                    <input type="search" name="nombre" placeholder="Buscar un producto..." value="{{$request->nombre}}"
                        class="py-2 px-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md" />
                </div>
                <div class="ml-4">
                    <select name="tipos"
                        class="ml-2 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md">
                        <option value="todos" @if($request->tipos=="todos") selected @endif>Todos...</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo }}" @if($tipo==$request->tipos) selected @endif>{{ $tipo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="ml-4">
                    <button type="reset" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"><i
                        class="fas fa-brush"></i></button>
                </div>
                <div class="ml-4">

                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i
                            class="fas fa-search"></i></button>
                </div>

        </div>
    </form>

    <x-estructuraTabla>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col">@sortablelink('id', 'ID')</i>
                    </th>
                    <th scope="col">@sortablelink('nombre', 'Nombre')</i>
                    </th>
                    <th scope="col">@sortablelink('fecha_venta', 'Fecha de venta')</i>
                    </th>
                    <th scope="col">@sortablelink('precio', 'Precio')</i>
                    </th>
                    <th scope="col">@sortablelink('cantidad', 'Stock')</i>
                    </th>
                    <th scope="col">@sortablelink('tipo', 'Tipo')</i>
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-center text-xs uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productos as $producto)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('products.show', $producto) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{$producto->id}}
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
                                {{ $producto->cantidad }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $producto->tipo }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('products.edit', $producto) }}"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit"></i></a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                            <form action="{{ route('products.destroy', $producto) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button onclick='return confirmar(this.form, "producto")' id="submitBtn" name="submitBtn"
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
        {{ $productos->links() }}
    </div>
</div>
@endsection
