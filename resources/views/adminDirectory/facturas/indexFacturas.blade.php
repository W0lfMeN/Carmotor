@extends('layouts.plantillaAdmin')
@section('cabecera')
Listado de facturas
@endsection
@section('contenido')
<div class="w-11/12 mx-auto px-2 mt-2">

    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (session('mensaje'))
        <x-alertaInfoVerde>
            {{ session('mensaje') }}
        </x-alertaInfoVerde>
    @endif

    <div class="my-4">
        <a href="{{ route('facturas.csv') }}" class="bg-green-500 font-bold hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800 text-white">
            <i class="fa-solid fa-file-export"></i> Exportar tabla a CSV</a>
    </div>

    <form name="bus" action="{{ route('facturas.index') }}" method="get">
        <div class="flex my-4">

                <div class="w-11/12">
                    <input type="search" name="codigo" placeholder="Buscar por Codigo" value="{{$request->codigo}}"
                        class="py-2 px-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="ml-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-search"></i></button>
                </div>
        </div>
    </form>
    <x-estructuraTabla>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col">@sortablelink('id', 'ID')</i>
                    </th>
                    <th scope="col">@sortablelink('codigo', 'Codigo del pedido')</i>
                    </th>
                    <th scope="col">@sortablelink('user_nombre', 'Nombre del comprador')</i>
                    </th>
                    <th scope="col">@sortablelink('product_id', 'Ids de los productos')</i>
                    </th>
                    <th scope="col">@sortablelink('precio', 'Precio')</i>
                    </th>
                    <th scope="col">@sortablelink('direccion', 'Direccion')</i>
                    </th>
                    <th scope="col">@sortablelink('created_at', 'Fecha de compra')</i>
                    </th>
                    <th scope="col">Productos</i>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs uppercase tracking-wider">
                        Accion
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($facturas as $factura)
                    <tr>
                        {{-- Id --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('facturas.show', $factura) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{$factura->id}}
                            </a>
                        </td>
                        {{--  --}}

                        {{-- Codigo --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ $factura->codigo }}
                                    </div>

                                </div>
                            </div>
                        </td>
                        {{--  --}}

                        {{-- Nombre del usuario --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $factura->user_nombre }}
                            </div>
                        </td>
                        {{--  --}}

                        {{-- IDs de los productos --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $factura->product_id }}
                            </div>
                        </td>
                        {{--  --}}

                        {{-- Precio de la factura --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $factura->precio }}&nbsp;€
                            </div>
                        </td>
                        {{--  --}}

                        {{-- Direccion de envio --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $factura->direccion }}
                            </div>
                        </td>
                        {{--  --}}

                        {{-- Fecha de compra --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($factura->created_at)->format('d - M - Y') }}
                            </div>
                        </td>
                        {{--  --}}

                        {{-- Productos comprados --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-center font-medium text-gray-900">
                                {{ $factura->pedido }}
                            </div>
                        </td>
                        {{--  --}}

                        {{-- Accion de borrar deshabilitada --}}
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="bg-red-500 {{-- hover:bg-red-700 --}} text-white font-bold py-2 px-4 rounded" disabled><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-estructuraTabla>

    <div class="mt-2 mb-10">
        {{ $facturas->links() }}
    </div>

</div>
@endsection
