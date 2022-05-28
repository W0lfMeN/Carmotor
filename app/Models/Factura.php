<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Factura extends Model
{
    use HasFactory;

    protected $fillable=['codigo', 'user_nombre', 'direccion', 'product_id', 'pedido', 'precio'];
    use Sortable;

    //Metodos scopes
    public function scopeCodigo($query, $v){
        if(!isset($v)){
            return $query->where('codigo', 'like', '%');
        }
        return $query->where('codigo', 'like', "%$v%");

    }
}
