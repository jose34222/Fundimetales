@extends('layouts.app', ['title' => 'Detalle de Cheque'])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Detalle del Cheque #{{ $cheque->numero_cheque }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('cheques.index') }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Número de Cheque</label>
                                    <p class="form-control-static">{{ $cheque->numero_cheque }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Banco</label>
                                    <p class="form-control-static">{{ $cheque->banco }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Valor</label>
                                    <p class="form-control-static">${{ number_format($cheque->valor, 2) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Fecha</label>
                                    <p class="form-control-static">{{ $cheque->fecha->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Cuenta Bancaria</label>
                                    <p class="form-control-static">{{ $cheque->cuenta->nombre ?? 'Sin cuenta asociada' }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Registrado por</label>
                                    <p class="form-control-static">{{ $cheque->usuario->name }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label">Observaciones</label>
                            <p class="form-control-static">{{ $cheque->observaciones ?? 'Ninguna' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer py-4">
                    <div class="text-right">
                        <a href="{{ route('cheques.edit', $cheque) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('cheques.destroy', $cheque) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cheque?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection