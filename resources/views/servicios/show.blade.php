@extends('layouts.app', ['title' => 'Detalles de Servicio'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Detalles de Servicio</h4>
                        <p class="card-category">Información completa del servicio</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><strong>Código:</strong> {{ $servicio->codigo }}</h5>
                                <h5><strong>Nombre:</strong> {{ $servicio->nombre }}</h5>
                                <h5><strong>Precio:</strong> ${{ number_format($servicio->precio, 2) }}</h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h5><strong>Descripción:</strong></h5>
                                <p>{{ $servicio->descripcion ?? 'No hay descripción disponible' }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <a href="{{ route('servicios.edit', $servicio->id) }}" class="btn btn-sm btn-success">
                                    <i class="material-icons">edit</i> Editar
                                </a>
                                <a href="{{ route('servicios.index') }}" class="btn btn-sm btn-default">
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