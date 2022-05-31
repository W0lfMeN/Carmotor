@component('mail::message')
# {{$subject}}

## Hola: {{$datosFactura['user_nombre']}}.
Muchas gracias por confiar en nosotros, a continuacion se te mostrarán los datos de la compra realizada.
## No pierda este correo, es de vital importancia en caso de que ocurra algo con el producto


Codigo de la factura: {{$datosFactura['codigo']}}

Listado de productos

@foreach ($listadoPedidos as $pedido)
    - {{$pedido}}
@endforeach

Coste total: {{$datosFactura['precio']}} €

Fecha de compra: {{\Carbon\Carbon::parse($datosFactura['created_at'])->format('d-m-Y')}}


Direccion de envio: {{$datosFactura['direccion']}}


Un saludo.

## El equipo de CarMotor.es
@endcomponent
{{-- Correo para informar de algo --}}
