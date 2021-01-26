<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_id','usuario_id','cantidad','descripcion','pago_entregado','folio'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
