<?php

namespace App\Http\Controllers;

use App\Models\pago;
use App\Models\venta;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index(){
        $usuarios = Usuario::all();
        return view('Pagos.index',compact('usuarios'));
    }

    public function pagar($id){
        $ventas = venta::where('usuario_id',$id)->where('pago_entregado',0)->get();
        $total=0;
        foreach($ventas as $venta){
           $total += $venta->producto->precio;
        }
        
        return view('Pagos.pagar',compact('ventas','id','total'));
    }

    public function createPago(Request $request){
        $pago = new pago;
        $pago->usuario_id = $request->IdUsuario;
        $pago->Total = $request->Total;
        $pago->save();
        return redirect()->route('nuevoPago');
    }
}
