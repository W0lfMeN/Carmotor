<?php

namespace App\Http\Controllers;

use App\Mail\FacturaCarritoMailable;
use App\Mail\FacturaSimpleMailable;
use App\Models\Brand;
use App\Models\Factura;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TiendaController extends Controller
{
    /* Funcion que muestra el catalogo de productos */
    public function tienda(Request $request){
        $marcas=Brand::orderBy('nombre', 'asc')->get();
        $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

        if($request->radioPrecio==1)
            $ordenPrecio="asc";
        else
            $ordenPrecio="desc";


        $marcaId=$request['radioMarcas'];

        if($marcaId==null){
            $productos=Product::where([['cantidad', '!=', 0]])->nombre($request->nombre)->tipos($request->radioTipos)->orderBy('precio', $ordenPrecio)->paginate(12)
            ->withQueryString();

        }else{
            $productos=Product::where([['cantidad', '!=', 0]])->whereHas('brands', function($query) use ($marcaId){
                $query->where('brands.id', $marcaId);
            })->nombre($request->nombre)->tipos($request->radioTipos)->orderBy('precio', $ordenPrecio)->paginate(12)->withQueryString();
        }

        return view('tienda.indexTienda', compact('productos', 'marcas', 'tipos', 'request'));
    }

    /* Funcion que muestra el producto seleccionado */
    public function tiendaProducto(Product $product){
        return view('tienda.showProductoTienda', compact('product'));
    }

    /* Funcion que muestra la lista de deseos del usuario */
    public function listaDeseos(){
        return view('tienda.showListaDeDeseos');
    }

    /* Funcion que muestra el carrito del usuario */
    public function carrito(){
        return view('tienda.showCarrito');
    }

    /* Funcion que mostrará la ventana de facturacion para el producto seleccionado */
    public function comprarProducto(Product $product){

        # primero debemos actualizar el producto y restarle 1 a la cantidad que hay disponible
        # Esto es lo que se hace a nivel empresarial para evitar que dos personas estén en el proceso de facturacion de un producto con 1 de stock
        /* $cantidadDelProducto=$product['cantidad']-1;
        $product->update(['cantidad'=>$cantidadDelProducto]); */

        if(Auth::check()){
            /* Si entra es que hay alguien logueado. separamos la direccion */
            $direccion=explode(',', Auth::user()->direccion);
        }else
            $direccion=null;

        /* dd($direccion); */

        return view('tienda.showFacturacionSimple', compact('product', 'direccion'));
    }

    public function comprarCarrito(){

        if(Auth::check()){
            /* Si entra es que hay alguien logueado. separamos la direccion */
            $direccion=explode(',', Auth::user()->direccion);
        }else
            $direccion=null;

        return view('tienda.showFacturacionCarrito', compact('direccion'));
    }


    public function procesarCompra(Request $request, Product $product){
        $request->validate([
            'name' => ['required', 'string'],
            'apellidos'=>['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],

            'calle' =>['required', 'string', 'max:255'],
            'cp' =>['required', 'digits:5'],
            'poblacion' =>['required', 'string', 'max:255'],
            'provincia' =>['required', 'string', 'max:255'],
        ]);
        /* dd($request->all()); */
        /* Si llega aqui es que se ha procesado todo correctamente */
        /* Creamos una factura, un correo y volvemos a la pagina principal */


        $factura=Factura::create([
            "codigo"=>Carbon::now()->timestamp.$product->id.random_int(1,1000),
            "user_nombre"=>$request['name']." ".$request['apellidos'],
            "direccion"=>$request['calle'].", ".$request['cp'].", ".$request['poblacion'].", ".$request['provincia'],
            "precio"=>$product['precio'],
            "product_id"=>$product->id,
            "pedido"=>$product->nombre
        ]);

        //si paso de aquí la validación ha ido bien
        $correo = new FacturaSimpleMailable($factura);

        try{
            Mail::to('soporte@carmotor.es')->send($correo);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('index')->with('correo', "No se pudo enviar el correo");
        }

        return redirect()->route('index')->with('correo', "Compra realizada, consulte su correo electronico");
    }

    public function procesarCarrito(Request $request){

        $request->validate([
            'name' => ['required', 'string'],
            'apellidos'=>['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],

            'calle' =>['required', 'string', 'max:255'],
            'cp' =>['required', 'digits:5'],
            'poblacion' =>['required', 'string', 'max:255'],
            'provincia' =>['required', 'string', 'max:255'],
        ]);

        $arrayIds=array_keys(\Cart::session(Auth::user()->id)->getContent()->toArray()); #Tenemos los ids en un array
        $cadenaIds=implode(",",$arrayIds); # Tenemos los ids en una cadena

        $arrayProductos=array_values(\Cart::session(Auth::user()->id)->getContent()->toArray()); #Tenemos los ids en un array
        $cadenaProductos="";
        foreach($arrayProductos as $producto){
            $cadenaProductos=$cadenaProductos.", ".$producto['name'];
        }
        $cadenaProductos=substr($cadenaProductos,1); #Quitamos la coma del principio y Tenemos los nombres en una cadena


        $factura=Factura::create([
            "codigo"=>Carbon::now()->timestamp.str_replace(',',"",$cadenaIds).random_int(1,1000),
            "user_nombre"=>$request['name']." ".$request['apellidos'],
            "direccion"=>$request['calle'].", ".$request['cp'].", ".$request['poblacion'].", ".$request['provincia'],
            "precio"=>\Cart::session(Auth::user()->id)->getSubTotal(),
            "product_id"=>$cadenaIds,
            "pedido"=>$cadenaProductos
        ]);

        //si paso de aquí la validación ha ido bien
        $correo = new FacturaCarritoMailable($factura);

        try{
            Mail::to('soporte@carmotor.es')->send($correo);

            \Cart::session(Auth::user()->id)->clear(); # Vaciamos el carrito
        }catch(\Exception $ex){
            
            return redirect()->route('index')->with('correo', "No se pudo enviar el correo");
        }

        return redirect()->route('index')->with('correo', "Compra realizada, consulte su correo electronico");

    }


    /* Funcion que se ejecuta cuando se pulsa el boton de añadir a la lista de deseos

       Primero comprobamos si este producto ya se encuentra en la lista
       Si está, lo borramos
       En caso contrario lo añadimos

       Mostramos por pantalla el mensaje correspondiente
    */
    public function addDeseo(Product $product){
        if($product->users->contains(Auth::user()->id)){
            $product->users()->detach(Auth::user()->id);

            $mensaje="Producto removido a la lista de deseos";
        }else{
            $product->users()->attach(Auth::user()->id);

            $mensaje="Producto añadido a la lista de deseos";
        }

        return back()->with("deseo", $mensaje);
    }


    /* Funcion que añade el producto seleccionado al carrito de compra */
    public function addCarrito(Product $product){

        \Cart::session(Auth::user()->id)->add(array(
            'id'=>$product->id,
            'name'=>$product->nombre,
            'price'=>$product->precio,
            'quantity'=>1,
            'attributes'=>array('imagen'=>$product->imagen),
        ));

        /* dd(\Cart::session(Auth::user()->id)->getContent()); */

        return back()->with("carrito", "Producto añadido al carrito");
    }

    public function borrarUnProductoCarrito($id){
        \Cart::session(Auth::user()->id)->remove($id);

        return back();
    }

    public function limpiarCarrito(){
        \Cart::session(Auth::user()->id)->clear();

        return back();
    }
}
