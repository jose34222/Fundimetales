@extends('layouts.app', ['title' => 'Productos del Proveedor'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Productos de: {{ $proveedor->nombre }}</h4>
                        <p class="card-category">Listado de productos suministrados por este proveedor</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-sm btn-default">
                                    <i class="material-icons">arrow_back</i> Volver al Proveedor
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if($proveedor->productos->count() > 0)
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedor->productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>${{ number_format($producto->precio, 2) }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td class="td-actions text-right">
                                            <a rel="tooltip" class="btn btn-info btn-link" 
                                               href="#" data-original-title="" title="">
                                                <i class="material-icons">visibility</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="alert alert-info">
                                Este proveedor no tiene productos asociados.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
