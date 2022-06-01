@extends('layouts.plantillaAdmin')
@section('cabecera')
Datos de la factura {{$factura->codigo}}
@endsection
@section('contenido')
<div class="bg-gray-300 rounded py-4 my-4 px-2 w-2/4 mx-auto">
    {{-- Id --}}
    <div class="p-5" >
        <p><b>Identificador de la factura:</b> {{$factura->id}}</p>
    </div>

    {{-- Codigo --}}
    <div class="p-5">
        <p><b>Codigo de la factura: </b>{{$factura->codigo}}</p>
    </div>

    <div class="grid grid-cols-2 gap-3">
        {{-- Comprador --}}
        <div class="p-5">
            <p><b>Comprador: </b>{{$factura->user_nombre}}</p>
        </div>

        {{-- Fecha de compra --}}
        <div class="p-5">
            <p><b>Fecha de compra: </b>{{ \Carbon\Carbon::parse($factura->created_at)->format('d - m - Y') }}</p>
        </div>
    </div>

    {{-- Direccion --}}
    <div class="p-5">
        <p><b>Direccion: </b>{{$factura->direccion}}</p>
    </div>

    {{-- Productos Comprados --}}
    <div class="p-5">
        <p><b>Productos comprados</b></p>
        <ul class="list-disc pl-5">
            @foreach ($productosComprados as $item)
                <li>{{$item}} <b>-> Su id es: {{$idsProductos[$loop->index]}}</b></li>
            @endforeach
        </ul>
    </div>

    {{-- Precio de la factura --}}
    <div class="p-5">
        <p><b>Coste total: </b>{{$factura->precio}} €</p>
    </div>

    {{-- Volver a index --}}
    <div class="p-5">
        <a href="{{ route('facturas.index') }}" class="bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"><i class="fas fa-backward"></i> Regresar</a>
    </div>
</div>
@endsection
