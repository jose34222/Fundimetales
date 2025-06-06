@extends('layouts.app', ['title' => 'Detalles de Proveedor'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Detalles de Proveedor</h4>
                        <p class="card-category">Información completa del proveedor</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><strong>ID:</strong> {{ $proveedor->id }}</h5>
                                <h5><strong>Nombre:</strong> {{ $proveedor->nombre }}</h5>
                                <h5><strong>Identificación:</strong> {{ $proveedor->identificacion }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Teléfono:</strong> {{ $proveedor->telefono }}</h5>
                                <h5><strong>Email:</strong> {{ $proveedor->email ?? 'No especificado' }}</h5>
                                <h5><strong>Productos:</strong> {{ $proveedor->productos->count() }}</h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h5><strong>Dirección:</strong></h5>
                                <p>{{ $proveedor->direccion ?? 'No especificada' }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <a href="{{ route('proveedores.productos', $proveedor->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="material-icons">list</i> Ver Productos
                                </a>
                                <a href="{{ route('proveedores.edit', $proveedor->id) }}" 
                                   class="btn btn-sm btn-success">
                                    <i class="material-icons">edit</i> Editar
                                </a>
                                <a href="{{ route('proveedores.index') }}" class="btn btn-sm btn-default">
                                    <i class="material-icons">arrow_back</i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection