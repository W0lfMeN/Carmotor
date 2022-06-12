<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    //
    /* Retornamos una vista del formulario de contacto */
    public function pintarFormulario(){
        return view('mails.contacto.formIndexContacto');
    }

    /* Funcion que procesa el formulario de contacto */
    public function procesarFormulario(Request $request){
        $request->validate([
            'nombre'=>['required', 'string', 'min:3'],
            'email'=>['required', 'email', 'min:3'],
            'mensaje'=>['required', 'string', 'min:10'],
        ]);

        //si paso de aquí la validación ha ido bien
        $correo = new ContactoMailable($request->all());

        try{
            Mail::to('soporte@carmotor.es')->send($correo); #Enviamos un correo al soporte
        }catch(\Exception $ex){

            return redirect()->route('index')->with('correo', "No se pudo enviar el correo"); #Volvemos con un mensaje de error
        }

        return redirect()->route('index')->with('correo', "Correo enviado, gracias"); #Volvemos
    }
}
