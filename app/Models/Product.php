<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'descripcion', 'imagen', 'imagen1', 'imagen2', 'precio', 'cantidad', 'fecha_venta', 'tipo'];
    use Sortable;

    /* Funciones */

    /* Funcion que se relaciona con la tabla Users */
    public function users(){
        return $this->belongsToMany(User::class);
    }

    /* Funcion que se relaciona con la tabla Brands */
    public function brands(){
        return $this->belongsToMany(Brand::class);
    }

    //Metodos scopes
    public function scopeNombre($query, $v){
        if(!isset($v)){
            return $query->where('nombre', 'like', '%');
        }
        return $query->where('nombre', 'like', "%$v%");

    }
    public function scopeTipos($query, $v){
        if($v=="todos" || !isset($v)){
            return $query->where('tipo', 'like', "%");
        }
        return $query->where('tipo' , $v);
    }
}
