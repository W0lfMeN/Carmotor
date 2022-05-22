<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InformacionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Informacion de CarMotor.es";

    public $datos=[];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        //Guardamos lo que llega del formulario en el array
        $this->datos=$datos; # Este array tiene 2 campos. Nombre y el mensaje
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /* Retorna una vista del correo en formato markdown */
        /* form = la persona que envia el correo */
        return $this->from(env('MAIL_FROM_ADDRESS'))->markdown('mails.informacion');
    }
}
