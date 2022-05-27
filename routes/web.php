<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProductController;
use App\Mail\ContactoMailable;
use App\Models\Brand;
use App\Models\Product;
use App\Models\UserProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    /* Desde laravel 5.3 es posible pasarle un array al where. En este caso queremos que se escojan 8 elementos aleatorios de entre todos los que cumplan las 2 condiciones */
    $piezasEnEscasez=Product::where([
        ['cantidad', '<=', 3],
        ['cantidad', '!=', 0]
    ])->get()->random(10);

    /* Carbon es una api que falicita las cosas con el formato DateTime */
    $piezasNuevas=Product::where('cantidad', '!=', 0)->whereDate('fecha_venta', '<=', Carbon::now()->add(-10, 'day')->format('Y-m-d'))->orderBy('fecha_venta', 'desc')->get()->random(10);

    $piezasInteresantes=Product::where('cantidad', '!=', 0)->take(100)->get()->random(10);

    return view('dashboard', compact('piezasEnEscasez', 'piezasInteresantes', 'piezasNuevas'));
})->name('index');

/* Vistas de la tienda principal */
Route::get('/tienda', [TiendaController::class, 'tienda'])->name('tienda');
Route::get('/tienda/{product:slug}', [TiendaController::class, 'tiendaProducto'])->name('tienda.producto');
Route::middleware(['auth:sanctum', 'verified'])->get('/tienda/addDeseo/{product:slug}', [TiendaController::class, 'addDeseo'])->name('tienda.addDeseo');
Route::middleware(['auth:sanctum', 'verified'])->get('/tienda/addCarrito/{product:slug}', [TiendaController::class, 'addCarrito'])->name('tienda.addCarrito');
Route::middleware(['auth:sanctum', 'verified'])->get('/listaDeDeseos', [TiendaController::class, 'listaDeseos'])->name('tienda.deseos');

/*  */

Route::middleware(['auth:sanctum', 'verified'])->get('/tienda2Mano', function(){

    $marcas=Brand::orderBy('nombre', 'asc')->get();
    $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

    $productosSegMano=UserProduct::whereDate('fecha_venta', '<=', Carbon::now()->add(-10, 'day')->format('Y-m-d'))->orderBy('fecha_venta', 'desc')->get();

    return view('tienda_2mano.index2Mano', compact('productosSegMano'));
})->name('tienda2Mano');

/* Envio de formulario de contacto */
Route::get('/contacto', [ContactoController::class, 'pintarFormulario'])->name('contacto.pintar');
Route::post('/contacto', [ContactoController::class, 'procesarFormulario'])->name('contacto.procesar');
/*  */


/* Zona donde colocaremos los enlaces donde solo podrán acceder los admins ademas de tener que verificar la cuenta */

Route::middleware(['role', 'verified'])->resource('products', ProductController::class); # Carga todas las rutas de Products
Route::middleware(['role', 'verified'])->resource('userProducts', UserProductController::class); # Carga todas las rutas de userProducts

Route::middleware(['role', 'verified'])->resource('/admin/brands', BrandController::class); # Carga todas las rutas de Brand

Route::middleware(['role', 'verified'])->resource('/admin/users', UserController::class); # Carga todas las rutas de Users
Route::middleware(['role', 'verified'])->get('/admin/users/rol/{user}', [UserController::class, 'rol'])->name('users.rol'); #Llama al metodo para cambiar su rol

Route::middleware(['role', 'verified'])->get('/admin', function () {
    return view('adminDirectory.index'); # Carga la vista del panel de administrador del admin
})->name('admin');

/*  */
