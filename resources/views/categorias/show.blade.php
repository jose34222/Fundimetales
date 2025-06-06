@extends('layouts.app', ['title' => 'Detalles de Categoría'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Detalles de Categoría</h4>
                        <p class="card-category">Información completa de la categoría</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><strong>ID:</strong> {{ $categoria->id }}</h5>
                                <h5><strong>Nombre:</strong> {{ $categoria->nombre }}</h5>
                                <h5><strong>Descripción:</strong> {{ $categoria->descripcion ?? 'No disponible' }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Productos asociados:</strong> {{ $categoria->productos->count() }}</h5>
                                <a href="{{ route('categorias.productos', $categoria->id) }}" 
                                   class="btn btn-sm btn-info">
                                    Ver Productos
                                </a>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-success">
                                    <i class="material-icons">edit</i> Editar
                                </a>
                                <a href="{{ route('categorias.index') }}" class="btn btn-sm btn-default">
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