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
                            <th scope="col">Marca como pagado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            <input type="hidden" value="{{$venta->id}}">
                            <td scope="row">{{$venta->producto->nombre}}</td>
                            <td scope="row">{{$venta->descripcion}}</td>
                            <td scope="row">{{$venta->producto->precio}}</td>
                            <td scope="row">
                                <input type="checkbox" class="marcar" name="pagado" >
                            </td>
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

{{-- modal marcar --}}
<div class="modal fade" id="marcar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Pagar cuentas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form onclick="event.preventDefault();">
                @csrf
                <input type="hidden" name="IdVenta" id="IdVenta">
                    <div class="modal-body">
                    <p>¿Marcar esta venta como pagada?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary enviar">Confirmar</button>
                    </div>
                    </div>
                </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection
@section('escripts2')
  <script>
    $('.marcar').on('change',function(){
        if(this.checked) {
            $tr = $(this).parents("tr");
            id = $tr.children("input[type=hidden]").val();
            $("#IdVenta").val(id);
            $('#marcar').modal('show')
        }
    
    });

    // cambio de valor en ajax}
    $('.enviar').on('click',function(event){
        $(".enviar").prop("disabled",true);
        let token = $("input[name=_token]").val();
        var route = "/_pagos/marcar";
        let IdVenta = $("#IdVenta").val();
    
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type: "put",
        datatype: "json",
        data: {
            IdVenta: IdVenta,
        },
        success: function(data){
        $(".enviar").prop("disabled",false);
        $('#marcar').modal('hide')
        alert('Se ha cambiado exitosamente');
        },
        error: function(data){
            $(".enviar").prop("disabled",false);
            console.log(data.responseJSON);
            alert('Algo salio mal');
            }
        })
});
  </script>
@endsection

$(".enviar").prop("disabled",true);
        let token = $("input[name=_token]").val();
        var route = "/_pagos/marcar";

