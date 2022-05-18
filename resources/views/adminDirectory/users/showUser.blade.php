@extends('layouts.plantillaAdmin')
@section('cabecera')
Datos del usuario {{$user->name}} con ID: {{$user->id}}
@endsection
@section('contenido')
<div class="bg-gray-300 rounded py-4 my-4 px-2 w-2/4 mx-auto">
    {{-- imagen --}}
    <div >
        <img src="{{ $user->getProfilePhotoUrlAttribute() }}" alt="imagen" class="rounded-full object-center w-24 h-24 mx-auto">
    </div>

    {{-- Nombre completo --}}
    <div class="p-5">
        <p><b>Nombre completo: </b>{{$user->name}}</p>
    </div>

    {{-- Correo electorinico --}}
    <div class="p-5">
        <p><b>Correo electronico: </b>{{$user->email}}</p>
    </div>

    {{-- Direccion --}}
    <div class="p-5">
        <p><b>Direccion: </b>{{$user->direccion}}</p>
    </div>

    {{-- Rol --}}
    <div class="p-5">
        <p><b>Tiene el rol de: </b>@if ($user->rol==1) Usuario normal @else Usuario <span class="text-red-500">Administrador</span>@endif</p>
    </div>

    {{-- Volver a index --}}
    <div class="p-5">
        <a href="{{ route('users.index') }}" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-backward"></i> Regresar</a>
    </div>
</div>
@endsection
