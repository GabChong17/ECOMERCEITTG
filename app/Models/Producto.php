<?php

namespace App\Models;

use App\Models\venta;
use App\Models\Imagenes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre','descripcion','precio','costo','cantidad','usuario_id','categoria_id','concesionado','motivo'];
    
    public function propietario(){
        return $this->hasOne('App\Models\Usuario','id','usuario_id');
    }

    public function preguntas(){
        return $this->hasMany('App\Models\Pregunta');//,'id','producto_id');
        //whereNotNull('p_autorizada')
    }
    public function categoria(){
        return $this->hasMany('App\Models\Categoria','id','categoria_id');
    }

    public function estaConcesionado(){
        if($this->concesionado) 
            return "SI";
        else
            return "No";
    }

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario');        
    }

    public function imagenes()
    {
        return $this->belongsToMany(Imagenes::class, 'imagene_producto','producto_id','imagen_id')
                        ->as('imagene_producto')
                        ->withTimestamps();
    }

    public function venta(){
        return $this->hasMany(venta::class);
    }
}
