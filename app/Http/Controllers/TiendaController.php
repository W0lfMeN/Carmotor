<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Factura;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('tienda.showListaDeDeseos',);
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
            
        }

        /* dd($direccion); */

        return view('tienda.showFacturacion', compact('product', 'direccion'));
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

        dd($factura['created_at']);

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

        return back()->with("carrito", "Producto añadido al carrito");
    }
}
