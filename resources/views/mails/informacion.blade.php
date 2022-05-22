@component('mail::message')
# {{$subject}}

## Hola: {{$datos['usuario']}}.

{{$datos['mensaje']}}

Un saludo.

El equipo de CarMotor.es
@endcomponent
{{-- Correo para informar de algo --}}
