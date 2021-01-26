<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
class ImagenProducto extends Pivot
{
    protected $table = 'imagene_producto';
    protected $fillable = [
        'imagen_id','producto_id',
    ];
}
