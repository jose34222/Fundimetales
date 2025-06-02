@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalle de Gasto'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Detalle del Gasto #{{ $gasto->id }}</h6>
                            <div>
                                <a href="{{ route('gastos.edit', $gasto) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="{{ route('gastos.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Fecha</label>
                                    <p class="form-control-static">{{ $gasto->fecha->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Concepto</label>
                                    <p class="form-control-static">{{ $gasto->concepto->nombre }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Valor</label>
                                    <p class="form-control-static text-danger font-weight-bold">${{ number_format($gasto->valor, 2) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Registrado por</label>
                                    <p class="form-control-static">{{ $gasto->usuario->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Detalles</label>
                            <p class="form-control-static">{{ $gasto->detalles ?? 'Sin detalles' }}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Fecha de creación</label>
                            <p class="form-control-static">{{ $gasto->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Última actualización</label>
                            <p class="form-control-static">{{ $gasto->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection