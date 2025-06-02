@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detalle de Venta #{{ $venta->id }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Información Básica</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Fecha:</th>
                                        <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cliente:</th>
                                        <td>{{ $venta->cliente->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Concepto:</th>
                                        <td>{{ $venta->concepto->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor:</th>
                                        <td>${{ number_format($venta->valor, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Información Adicional</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Cuenta Bancaria:</th>
                                        <td>{{ $venta->cuenta ? $venta->cuenta->nombre . ' (' . $venta->cuenta->banco . ')' : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registrado por:</th>
                                        <td>{{ $venta->usuario->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de registro:</th>
                                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h4>Observaciones</h4>
                                <div class="well well-sm">
                                    {{ $venta->observaciones ?: 'Sin observaciones' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('ventas.index') }}" class="btn btn-default">Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection