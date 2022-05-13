<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Tabla MARCAS */
class Brand extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable=['nombre', 'descripcion'];

    public $sortable = ['id', 'nombre'];
    /* Funciones */

    /* Funcion que se relaciona con la tabla Users */
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
