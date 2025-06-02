@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalles del Envío'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Información del Envío</h6>
                        <div>
                            <a href="{{ route('envios.edit', $envio->envio_id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <a href="{{ route('envios.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Referencia</label>
                                    <p class="form-control-static">{{ $envio->referencia }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Fecha</label>
                                    <p class="form-control-static">{{ $envio->fecha->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Cliente</label>
                                    <p class="form-control-static">{{ $envio->cliente->nombre ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Cuenta Bancaria</label>
                                    <p class="form-control-static">
                                        @if($envio->cuenta)
                                            {{ $envio->cuenta->banco }} - {{ $envio->cuenta->numero_cuenta }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Lugar</label>
                                    <p class="form-control-static">{{ $envio->lugar }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Valor</label>
                                    <p class="form-control-static">${{ number_format($envio->valor, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Autoriza</label>
                                    <p class="form-control-static">{{ $envio->autoriza ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Observaciones</label>
                                    <p class="form-control-static">{{ $envio->observaciones ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Registrado por</label>
                                    <p class="form-control-static">{{ $envio->usuario->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Fecha de registro</label>
                                    <p class="form-control-static">{{ $envio->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection