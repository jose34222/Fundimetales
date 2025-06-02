@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalle de Concepto'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Detalle del Concepto</h6>
                            <div>
                                <a href="{{ route('conceptos.edit', $concepto) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="{{ route('conceptos.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nombre</label>
                                    <p class="form-control-static">{{ $concepto->nombre }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Tipo de Concepto</label>
                                    <p class="form-control-static">
                                        <span class="badge badge-sm bg-gradient-{{ $concepto->tipo_concepto == 'ingreso' ? 'success' : 'danger' }}">
                                            {{ $concepto->tipo_concepto }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Descripción</label>
                            <p class="form-control-static">{{ $concepto->descripcion ?? 'Sin descripción' }}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Fecha de creación</label>
                            <p class="form-control-static">{{ $concepto->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Última actualización</label>
                            <p class="form-control-static">{{ $concepto->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection