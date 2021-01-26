<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imagenes extends Model
{
    use HasFactory;
    protected $table = 'imagenes';
    protected $fillable = [
        'ruta','producto_id',
    ];

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'imagene_producto','imagen_id','producto_id')
                        ->as('imagene_producto')
                        ->withTimestamps();
    }
}
