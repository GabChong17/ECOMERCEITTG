@extends('layout.general')


@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="mb-0">Nueva venta</h3>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form  onclick="event.preventDefault();">
                        <div class="form-group form-row">
                            <div class="col-md-12">
                                <label for="producto">producto</label>
                                <select name="producto_id[]" id="producto_id" multiple="multiple" class="form-control @error('producto_id') is-invalid @enderror">
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}">{{$producto->nombre}}-${{$producto->precio}}</span>
                                        </option>
                                    @endforeach
                                </select>
                                @error('producto_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" id="pagar" data-toggle="modal"data-target="#vender" class="btn btn-success btn-lg">Realizar venta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="vender" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Eliminar definitivamente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('venta.create')}}" method="post">
                @csrf
                    <div class="modal-body">
                    <div class="ventaProducto">
                        {{--aca se van creando los productos que se seleccionen mediante js/jquery --}}
                    </div>
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                    <p>¿Esta seguro que desea hacer la venta?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
@section('escripts2')
    <script type="text/javascript">
        $("#producto_id").on('click',function(){
            $(".ventaProducto").html('');
            let array=[];
            let precios = $("#producto_id option:selected").map(function(){
                texto = $(this).text();
                precio = texto.split('$');
                array = $(this).val().toString()+'-'+precio[0].trim() + precio[1].trim();
                return array;
            });
           let total = 0;
            precios.each(function(index,precio){
                datos = precio.split("-");
                $(".ventaProducto").append(`<div style="border: 1px solid #999">
                            <input type="hidden" value="`+datos[0]+`" name="idProducto`+index+`">
                            <input type="hidden" value="`+datos[2]+`" class="precio">
                            <label>`+datos[1]+`</label><br>
                            <label>Cantidad</label>
                            <input type="number" class="form-control" step="1" value="1" min="1" name="cantidad`+index+`">
                        </div><br>`);
            });
        });
    </script>
@endsection