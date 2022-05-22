<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class UserProduct extends Model
{
    use HasFactory;
    use Sortable;
    protected $fillable=['nombre', 'descripcion', 'imagen', 'imagen1', 'imagen2', 'precio', 'kms', 'fecha_venta', 'tipo'];

    /* Funciones */

    /* Relacion con la tabla Users */
    public function user(){
        return $this->belongsTo(User::class);
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
