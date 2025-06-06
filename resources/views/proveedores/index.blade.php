@extends('layouts.app', ['title' => 'Gestión de Proveedores'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Proveedores</h4>
                        <p class="card-category">Listado de proveedores registrados</p>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('success') }}</span>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('proveedores.create') }}" class="btn btn-sm btn-primary">
                                    <i class="material-icons">add</i> Nuevo Proveedor
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Identificación</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Productos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td>{{ $proveedor->id }}</td>
                                        <td>{{ $proveedor->nombre }}</td>
                                        <td>{{ $proveedor->identificacion }}</td>
                                        <td>{{ $proveedor->telefono }}</td>
                                        <td>{{ $proveedor->email ?? 'No especificado' }}</td>
                                        <td>
                                            <a href="{{ route('proveedores.productos', $proveedor->id) }}" 
                                               class="btn btn-sm btn-info">
                                                Ver Productos ({{ $proveedor->productos->count() ?? 0 }})
                                            </a>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a rel="tooltip" class="btn btn-info btn-link" 
                                               href="{{ route('proveedores.show', $proveedor->id) }}" 
                                               data-original-title="" title="">
                                                <i class="material-icons">visibility</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <a rel="tooltip" class="btn btn-success btn-link" 
                                               href="{{ route('proveedores.edit', $proveedor->id) }}" 
                                               data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" rel="tooltip" class="btn btn-danger btn-link" 
                                                        data-original-title="" title=""
                                                        onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection