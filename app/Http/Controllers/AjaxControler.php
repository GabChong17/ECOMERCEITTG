<?php

namespace App\Http\Controllers;

use App\Models\venta;
use App\Models\Usuario;
use App\Models\Categoria;
use Illuminate\Http\Request;



class AjaxControler extends Controller
{
    public function updateUsuario(Request $request, $id)
    {

        $valores = $request->all();
        $registro = Usuario::find($id);
        if(is_null($registro))  response()->json( ["error"=>"Registro no encontrado"] ,404);
        $registro->fill($valores);
        $registro->save();
        return response()->json($registro->toArray(),200);
    }
    public function storeCategoria(Request $request)
    {
        $valores = $request->all();
        $registro = new Categoria();
        $registro->fill($valores);
        $registro->save();
        return response()->json($registro->toArray(),200);
    }
    public function destroyCategoria($id)
    {
        try {
            $registro = Categoria::find($id);
            if(is_null($registro))  response()->json( ["error"=>"Registro no encontrado"] ,404);
            $a= $registro->toArray();
            $registro->delete();
            return response()->json($registro->toArray(),200);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json( ["error" => $e->getMessage() ] ,500);
        }
    }

    public function marcarPago(Request $request){
        try{
            if($request->ajax()){
                $venta = venta::find($request->IdVenta);
                $venta->pago_entregado = 1;
                $venta->save();
            }

        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json( ["error" => $e->getMessage() ] ,500);
        }

    }
}
