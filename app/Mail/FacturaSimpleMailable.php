<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FacturaSimpleMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Gracias por comprar en CarMotor.es";

    public $datosFactura=[];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        //Guardamos los datos de la factura en el array
        $this->datosFactura=$datos; # Este array tendrá todos los campos de la factura

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /* Retorna una vista del correo en formato markdown */
        /* from = la persona que envia el correo */
        return $this->from(env('MAIL_FROM_ADDRESS'))->markdown('mails.facturas.facturaSimple');
    }
}
