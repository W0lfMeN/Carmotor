@component('mail::message')
# Formulario de {{$subject}}

## Nombre

{{$datos['nombre']}}

## Correo

{{$datos['email']}}

***
## Mensaje

{{$datos['mensaje']}}
@endcomponent

{{-- Correo para los formularios --}}
