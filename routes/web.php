<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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
    $piezas=Product::where('cantidad', '!=', 0)->take(100)->get()->random(50);
    return view('dashboard', compact('piezas'));
})->name('index');

Route::resource('products', ProductController::class); # Carga todas las rutas de Products
Route::resource('userProducts', UserProductController::class); # Carga todas las rutas de userProducts
Route::resource('brands', BrandController::class); # Carga todas las rutas de Brand

/* Puede que falte el controller de Users */
