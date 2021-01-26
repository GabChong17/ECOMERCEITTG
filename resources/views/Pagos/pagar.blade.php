@extends('layout.general')


@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Productos">Productos</a></li>
<li class="breadcrumb-item active" aria-current="page">Listar</li>
@endsection


@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Ventas no pagadas</h3>
                    </div>
                    <div>
                        <button type="button" data-toggle="modal"data-target="#pagar"  class="btn btn-primary">
                            Pagar ventas
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
        
                <!-- tabla aca -->
                <table class="table table-hover">
                    
                    <thead>
                        <tr>
                            <th scope="col">Nombre de producto</th>
                            <th scope="col">Descripcion de venta</th>
                            <th scope="col">precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            <td scope="row">{{$venta->producto->nombre}}</td>
                            <td scope="row">{{$venta->descripcion}}</td>
                            <td scope="row">{{$venta->producto->precio}}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pagar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Pagar cuentas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('createPago')}}" method="post">
                @csrf
                <input type="hidden" value="{{$id}}" name="IdUsuario">
                <input type="hidden" value="{{$total}}" name="Total">
                    <div class="modal-body">
                    <p>¿pagar todas las cuentas pendientes?</p>
                    <p>TOTAL A PAGAR: {{$total}} PESOS</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Si, pagar</button>
                    </div>
                    </div>
                </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection



