<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Aqui se llama para retornar la vista de index de productos
        try {
            $productos=Product::sortable('id')->nombre($request->nombre)->tipos($request->tipos)->paginate(10)->withQueryString();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            dd($e);
        }

        $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

        return view('adminDirectory.productos.indexProductos', compact('productos', 'tipos', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

        $marcas=Brand::orderBy('id', 'asc')->get();
        //Retornamos una vista del createProduct
        return view('adminDirectory.productos.createProductos', compact('tipos', 'marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

        //
        //dd($request->all());
        $request->validate([
            'nombre'=>['required', 'string', 'min:2'],
            'descripcion'=>['required', 'string', 'min:20'],
            'precio'=>['required', 'digits_between:1,5', 'min:0'],
            'cantidad'=>['required', 'digits_between:0,3', 'min:0'],
            'fecha_venta'=>['required', 'date_format:d/m/Y'],
            'tipo'=>['required', 'string', 'in:' . implode(',', $tipos)],
            'marcas'=>['required'],

            'imagen'=>['required', 'image', 'max:1024'],
            'imagen1'=>['nullable', 'image', 'max:1024'],
            'imagen2'=>['nullable', 'image', 'max:1024'],
        ]);

        #Ajustamos la fecha al formato de mysql
        $request['fecha_venta']= (Carbon::createFromFormat('d/m/Y', $request['fecha_venta']))->format('Y-m-d');

        /* Si llega aqui es que está todo correcto */

        /* comprobacion para imagenes */

        $nombreSinEspacios=str_replace(" ","_",$request['nombre']); /* Reemplazamos todos los espacios por una barraBaja en la cadena del nombre */

        //se ha subido la imagen la almaceno físicamente
        $url = Storage::put("carmotor/tienda/".$request['tipo']."/$nombreSinEspacios"."/", $request->file('imagen'));

        //Creo la url que insertaré en la base de datos
        $urlBuena = "carmotor/tienda/".$request['tipo']."/$nombreSinEspacios"."/" . basename($url);

        //Creamos el producto y nos quedamos con la instancia
        $producto = Product::create($request->all());

        //Añadimos la url
        $producto->update(['imagen' => $urlBuena]);


        /* Ahora comprobamos si hay mas imagenes. Si las hay las añadimos a la instancia del producto */
        if ($request->file('imagen1')) {
            $url = Storage::put("carmotor/tienda/".$request['tipo']."/$nombreSinEspacios"."/", $request->file('imagen1'));
            $urlBuena1 = "carmotor/tienda/".$request['tipo']."/$nombreSinEspacios"."/" . basename($url);

            $producto->update(['imagen1' => $urlBuena1]);
        }

        if ($request->file('imagen2')) {
            $url = Storage::put("carmotor/tienda/".$request['tipo']."/$nombreSinEspacios"."/", $request->file('imagen2'));
            $urlBuena2 = "carmotor/tienda/".$request['tipo']."/$nombreSinEspacios"."/" . basename($url);

            $producto->update(['imagen2' => $urlBuena2]);
        }

        /* Fin de comprobacion de imagenes */

        //almacenamos en la tabla brands_products los brands de este producto
        $producto->brands()->attach($request->marcas);
        //----

        return redirect()->route('products.index')->with('mensaje', 'Producto Creado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('adminDirectory.productos.showProductos', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

        $marcas=Brand::orderBy('id', 'asc')->get();
        $arrayMarcas = $product->brands->pluck('id')->toArray(); #Obtenemos el id de todas las marcas asociadas a este producto y las metemos en un array
        //Retornamos una vista del editProduct
        return view('adminDirectory.productos.editProductos', compact('product','tipos', 'marcas', 'arrayMarcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        /* Proceso para obtener la ruta de la carpeta donde están las 3 imagenes */

        # $userProduct->imagen Contiene la ruta de la imagen entera desde la raiz
        $nombreImagen=basename($product->imagen); #Obtengo el nombre de la imagen
        $rutaCarpeta=str_replace($nombreImagen, "", $product->imagen); #Reemplazo ese nombre por vacío. Por lo que ya obtengo la ruta a la carpeta
        //dd($rutaCarpeta);
        /*  */

        Storage::deleteDirectory($rutaCarpeta); # Se borra la carpeta que contiene las 3 imagenes
        $product->delete();

        return redirect()->route('products.index')->with('mensaje', "Producto borrado");
    }
}
