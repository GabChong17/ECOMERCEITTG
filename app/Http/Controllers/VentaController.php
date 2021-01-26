<?php

namespace App\Http\Controllers;

use App\Models\venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    public function index(){
        $productos = Producto::all();
        return view('Ventas.venta',compact('productos'));
    }

    public function create(Request $request){
        $ventas = $request->except('_token', 'descripcion');
        $numeroVentas = (count($ventas)/2);
        $folio = time();
        for($i=0;$i<$numeroVentas;$i++){
            $varId= 'idProducto'.$i;
            $varCantidad= 'cantidad'.$i;
            $modelventa = new venta;
            $modelventa->producto_id=$request[$varId];
            $modelventa->usuario_id=Auth::user()->id;
            $modelventa->cantidad=$request[$varCantidad];
            $modelventa->descripcion=$request->descripcion;
            $modelventa->pago_entregado=0;
            $modelventa->folio=$folio;
            $modelventa->save();
        }
        return  redirect()->route('home');
    }
}
