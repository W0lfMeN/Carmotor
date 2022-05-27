<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TiendaController extends Controller
{
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

    public function tiendaProducto(Product $product){

        return view('tienda.showProductoTienda', compact('product'));
    }

    public function listaDeseos(){
        return view('tienda.showListaDeDeseos',);
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

    public function addCarrito(Product $product){

        return back()->with("carrito", "Producto añadido al carrito");

        return back();

    }
}
