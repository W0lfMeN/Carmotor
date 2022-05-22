<?php

namespace App\Http\Controllers;

use App\Mail\InformacionMailable;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Retornamos el view de la vista
        try {
            $productosUser=UserProduct::sortable('id')->nombre($request->nombre)->tipos($request->tipos)->paginate(10)->withQueryString();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            dd($e);
        }

        $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

        return view('adminDirectory.productos_users.indexProductosUsers', compact('productosUser', 'tipos', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function show(UserProduct $userProduct)
    {
        //
        return view('adminDirectory.productos_users.showProductosUsers', compact('userProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProduct $userProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProduct $userProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProduct $userProduct)
    {
        //
        $contenidoDelCorreo=[
            "mensaje"=>"Nos ponemos en contacto con usted para notificarle de que el producto '$userProduct->nombre'
                        ha sido eliminado de la web debido a un incumplimiento de nuestras politicas.
                        Lamentamos este incidente pero debemos de mantener una serie de normas para evitar problemas.",

            "usuario"=>$userProduct->user->name
        ];

        $correo = new InformacionMailable($contenidoDelCorreo);

        try{
            Mail::to($userProduct->user->email)->send($correo);
        }catch(\Exception $ex){

        }

        /* Proceso para obtener la ruta de la carpeta donde están las 3 imagenes */

        # $userProduct->imagen Contiene la ruta de la imagen entera desde la raiz
        $nombreImagen=basename($userProduct->imagen); #Obtengo el nombre de la imagen
        $rutaCarpeta=str_replace($nombreImagen, "", $userProduct->imagen); #Reemplazo ese nombre por vacío. Por lo que ya obtengo la ruta a la carpeta
        #dd($rutaCarpeta);
        /*  */

        Storage::deleteDirectory($rutaCarpeta); # Se borra la carpeta que contiene las 3 imagenes
        $userProduct->delete();

        return redirect()->route('userProducts.index')->with('mensaje', "Producto borrado e informado");
    }
}
