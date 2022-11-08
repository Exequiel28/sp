<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;
    protected $table="ordenes";
    public function pedidos(){
        return $this->belongsTo(Pedido::class, 'id_pedido');
        
    }
}
