<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FacturaCarritoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Gracias por comprar en CarMotor.es";

    public $datosFactura=[];
    public $listadoPedidos=[];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
         //Guardamos los datos de la factura en el array
         $this->datosFactura=$datos; # Este array tendrá todos los campos de la factura

         $this->listadoPedidos=explode(",",$datos['pedido']); #Metemos todos los pedidos en un array
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->markdown('mails.facturas.facturaCarrito'); #Enviamos el correo
    }
}
