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

        /* Si se ha deseado filtrar por marcas, la sentencia sql que se ejecuta es esta. En caso contrario se ejecuta otra*/
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

    /* Funcion que carga la vista del formulario del carrito */
    public function comprarCarrito(){

        if(Auth::check()){
            /* Si entra es que hay alguien logueado. separamos la direccion */
            $direccion=explode(',', Auth::user()->direccion);
        }else
            $direccion=null;

        return view('tienda.showFacturacionCarrito', compact('direccion'));
    }


    /* Funcion que valida el formulario de la compra de un producto */
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
            "codigo"=>substr(Carbon::now()->timestamp,-10).random_int(1,1000),
            "user_nombre"=>$request['name']." ".$request['apellidos'],
            "direccion"=>$request['calle'].", ".$request['cp'].", ".$request['poblacion'].", ".$request['provincia'],
            "precio"=>$product['precio'],
            "product_id"=>$product->id,
            "pedido"=>$product->nombre
        ]);

        //si paso de aquí la validación ha ido bien
        $correo = new FacturaSimpleMailable($factura);

        try{
            Mail::to($request['email'])->send($correo);

            if(Auth::check()){
                /* Si el producto comprado se encuentra en la lista de deseos, se borra de dicha lista */
                if($product->users->contains(Auth::user()->id)){
                    $product->users()->detach(Auth::user()->id);
                }
            }
        }catch(\Exception $ex){
            //dd($ex);
            return redirect()->route('index')->with('correo', "No se pudo enviar el correo");
        }

        return redirect()->route('index')->with('correo', "Compra realizada, consulte su correo electronico");
    }

    /* Funcion que valida el formulario del carrito */
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
            "codigo"=>substr(Carbon::now()->timestamp,-10).random_int(1,1000),
            "user_nombre"=>$request['name']." ".$request['apellidos'],
            "direccion"=>$request['calle'].", ".$request['cp'].", ".$request['poblacion'].", ".$request['provincia'],
            "precio"=>\Cart::session(Auth::user()->id)->getSubTotal(),
            "product_id"=>$cadenaIds,
            "pedido"=>$cadenaProductos
        ]);

        //si paso de aquí la validación ha ido bien
        $correo = new FacturaCarritoMailable($factura);

        //$contador=0;
        //$i=0;
        try{

           if(Auth::check()){
                /* Comprobamos si alguno de los productos que han sido comprados se encuentra en la lista de deseos.
                   Si este se encuentra, se elimina de dicha lista
                */
                for($i=0; $i<count(Auth::user()->products);$i++){

                    /* Este isset se ha puesto porque si el producto se encuentra en la lista de deseos y se quiere comprar mas de una cantidad de dicho producto
                       Provoca un error. El error que provoca es "undefined array key (posicion donde está numero del producto)
                       Es por esto que se ha puesto este isset que comprueba que existe la posicion del array a la que queremos acceder
                       si existe se comprueba, en caso contrario no hace nada.

                       El problema puede ser ocasionado porque no se porqué (tal vez por la cantidad del producto)
                       se realiza una iteracion de mas y por eso busca una posicion nula
                    */
                    if(isset($arrayIds[$i])){
                        if(Auth::user()->products->contains($arrayIds[$i])){
                            Auth::user()->products()->detach($arrayIds[$i]);
                            //$contador++;
                        }
                    }
                }
           }
            Mail::to($request['email'])->send($correo);


            \Cart::session(Auth::user()->id)->clear(); # Vaciamos el carrito
        }catch(\Exception $ex){
            //dd(["EXception"=>$ex,"contador" => $contador, "ArraysIds"=>$arrayIds, "Iteracion numero"=>$i, "Auth::user->product" =>Auth::user()->products, "Auth::user->product" =>count(Auth::user()->products) ]);
            return redirect()->route('index')->with('correo', "No se pudo enviar el correo"); #Volvemos con un mensaje de error
        }

        return redirect()->route('index')->with('correo', "Compra realizada, consulte su correo electronico"); #Volvemos

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

        return back()->with("deseo", $mensaje); #Volvemos
    }


    /* Funcion que añade el producto seleccionado al carrito de compra */
    public function addCarrito(Product $product){

        /* Si entra aqui es que se está intentando añadir al carrito un producto agotado, impedimos que eso ocurra */
        if($product->cantidad==0){
            return redirect()->route('tienda.producto', compact('product'));
        }else{
            /* Creamos en el carrito el producto */
            \Cart::session(Auth::user()->id)->add(array(
                'id'=>$product->id,
                'name'=>$product->nombre,
                'price'=>$product->precio,
                'quantity'=>1,
                'attributes'=>array('imagen'=>$product->imagen),
            ));

            return back()->with("carrito", "Producto añadido al carrito"); #Volvemos
        }
    }

    /* Funcion que borra un producto del carrito */
    public function borrarUnProductoCarrito($id){
        /* Si en dicho producto hay mas de una cantidad, se le resta una. Si la cantidad ya es 1 se borra del carrito */
        if(\Cart::session(Auth::user()->id)->get($id)->quantity==1){

            \Cart::session(Auth::user()->id)->remove($id);
        }else{
            \Cart::session(Auth::user()->id)->update($id, array('quantity'=>-1));
        }

        return back();
    }

    /* Funcion que limpia el carrito de compra */
    public function limpiarCarrito(){
        \Cart::session(Auth::user()->id)->clear();

        return back(); #Volvemos
    }
}
