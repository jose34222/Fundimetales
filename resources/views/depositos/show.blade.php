@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalle de Depósito'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Detalle del Depósito #{{ $deposito->id }}</h6>
                            <div>
                                <a href="{{ route('depositos.edit', $deposito) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="{{ route('depositos.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Fecha:</strong> &nbsp; {{ $deposito->fecha->format('d/m/Y') }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Cuenta Bancaria:</strong> &nbsp; {{ $deposito->cuenta->nombre }} ({{ $deposito->cuenta->numero_cuenta }})
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Valor:</strong> &nbsp; ${{ number_format($deposito->valor, 2) }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Concepto:</strong> &nbsp; {{ $deposito->concepto->nombre ?? 'N/A' }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Registrado por:</strong> &nbsp; {{ $deposito->usuario->name }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Fecha de registro:</strong> &nbsp; {{ $deposito->created_at->format('d/m/Y H:i') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Observaciones</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-sm">{{ $deposito->observaciones ?? 'Sin observaciones' }}</p>
                                    </div>
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