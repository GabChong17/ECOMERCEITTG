@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Productos">Productos</a></li>
<li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
<br>
@endif
<form action="/Productos/{{$producto->id}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Nombre:</label>
     <input type="text" name="nombre" class="form-control" value="{{$producto->nombre}}">
    </div>

  @can('cambios', $producto)
    <div class="form-group">
        <label>Descripcion: </label>
        <textarea class="form-control" name="descripcion" rows="3">{{$producto->descripcion}}</textarea>
    </div>

    <div class="input-group">
      <label >Precio:</label>
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="text" name="precio" class="form-control" value="{{$producto->precio}}">
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  @else
    <div class="form-group">
        Descripcion: {{$producto->descripcion}}
    </div>

    <div class="input-group">
      Precio: ${{$producto->precio}}.00
    </div>

@endcan
  
      <div class="form-group">
          <label for="imagen">Imagenes:</label><br>
          @if($producto->concesionado)
            @foreach($producto->imagenes as $imagen)
              <div class="foto">
                <input type="hidden" value="{{$imagen->id}}">
                <img src="{{asset('../prods/'.$imagen->ruta)}}"  width="200" class="img-thumnail"><br>
              </div>
            @endforeach
          @else
            @foreach($producto->imagenes as $imagen)
              <div class="foto">
                <input type="hidden" value="{{$imagen->id}}">
                <img src="{{asset('../prods/'.$imagen->ruta)}}"  width="200" class="img-thumnail"><br>
                <button type="button" data-toggle="modal"data-target="#borrarFoto" class="btn btn-primary delete">Quitar foto</button>
              </div>
            @endforeach
          @endif
          <br><br><label for="imagen">Agregar más fotos</label><br>
          <input type="file" name="imagen[]" id="imagen" multiple="">
      </div>
      <input type="hidden" name="usuario_id" value="{{Auth::id()}}">
      <div class="form-group">
        <label>Categoria:</label>
        <select name="categoria_id">
          @foreach ($categorias as $categoria)
              <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
          @endforeach
        </select>
    </div>
    @if (!is_null($producto->concesionado) && $producto->concesionado==0)
    <div class="alert alert-danger" role="alert">
      Motivo por el cual no fue aceptado: {{$producto->motivo}}
    </div>
    @endif
  
    <input type="submit" class="btn btn-primary" value="Enviar">    
</form>
<div class="modal fade" id="borrarFoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myLargeModalLabel">Eliminar definitivamente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <form action="{{route('delete.photo')}}" method="post">
              @csrf
              @method('delete')
              <input type="hidden" name="IdFotoProducto" id="IdFotoProducto">
              <input type="hidden" name="IdProducto" id="IdProducto" value="{{$producto->id}}">
                  <div class="modal-body">
                  <p>¿Esta seguro que desea eliminar esta imagen definitivamente?</p>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Si, Eliminar</button>
                  </div>
                  </div>
              </form>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('escripts2')
<script>
  $('.delete').on('click', function(){
    $div = $(this).closest('.foto');
     var id = $div.children("input[type=hidden]").val();
    $("#IdFotoProducto").val(id);
});
</script>
@endsection