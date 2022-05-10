<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'descripcion', 'imagen', 'imagen1', 'imagen2', 'precio', 'cantidad', 'fecha_venta', 'tipo'];
    
    /* Funciones */

    /* Relacion con la tabla Users */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
