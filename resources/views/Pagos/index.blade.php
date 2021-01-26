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
                        <h3 class="mb-0">Pagos</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
        
                <!-- tabla aca -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre de cliente</th>
                            <th scope="col" style="width: 150px">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td scope="row">{{ $usuario->nombre }} {{ $usuario->a_paterno}} {{ $usuario->a_materno}}</td>
                            <td>
                                <a href="{{route('pagar',['id'=>$usuario->id])}}" class="btn btn-outline-danger btn-sm btn-delete"> Ver ventas</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



