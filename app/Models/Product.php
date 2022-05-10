<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'descripcion', 'imagen', 'imagen1', 'imagen2', 'precio', 'kms', 'fecha_venta', 'tipo'];

    /* Funciones */

    /* Funcion que se relaciona con la tabla Users */
    public function users(){
        return $this->belongsToMany(User::class);
    }

    /* Funcion que se relaciona con la tabla Brands */
    public function brands(){
        return $this->belongsToMany(Brand::class);
    }
}
