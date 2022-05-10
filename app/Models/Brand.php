<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Tabla MARCAS */
class Brand extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'descripcion'];
    /* Funciones */

    /* Funcion que se relaciona con la tabla Users */
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
