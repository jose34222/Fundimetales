@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Editar Venta #{{ $venta->id }}</h3>
                    </div>
                    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $venta->fecha->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cliente_id">Cliente</label>
                                        <select class="form-control" id="cliente_id" name="cliente_id" required>
                                            @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="concepto_id">Concepto</label>
                                        <select class="form-control" id="concepto_id" name="concepto_id" required>
                                            @foreach($conceptos as $concepto)
                                                <option value="{{ $concepto->id }}" {{ $venta->concepto_id == $concepto->id ? 'selected' : '' }}>{{ $concepto->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cuenta_id">Cuenta Bancaria</label>
                                        <select class="form-control" id="cuenta_id" name="cuenta_id">
                                            <option value="">Seleccione una cuenta (opcional)</option>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->id }}" {{ $venta->cuenta_id == $cuenta->id ? 'selected' : '' }}>{{ $cuenta->nombre }} ({{ $cuenta->banco }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="valor">Valor</label>
                                        <input type="number" step="0.01" class="form-control" id="valor" name="valor" value="{{ $venta->valor }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{ $venta->observaciones }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Actualizar Venta</button>
                            <a href="{{ route('ventas.index') }}" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection