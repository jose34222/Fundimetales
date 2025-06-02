@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Depósito'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Editar Depósito #{{ $deposito->id }}</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('depositos.update', $deposito) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha" class="form-control-label">Fecha</label>
                                        <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', $deposito->fecha->format('Y-m-d')) }}">
                                        @error('fecha')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cuenta_id" class="form-control-label">Cuenta Bancaria</label>
                                        <select class="form-control @error('cuenta_id') is-invalid @enderror" id="cuenta_id" name="cuenta_id">
                                            <option value="">Seleccione una cuenta</option>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->cuenta_id }}" {{ old('cuenta_id', $deposito->cuenta_id) == $cuenta->cuenta_id ? 'selected' : '' }}>
                                                    {{ $cuenta->nombre }} ({{ $cuenta->numero_cuenta }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('cuenta_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="valor" class="form-control-label">Valor</label>
                                        <input type="number" step="0.01" class="form-control @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor', $deposito->valor) }}">
                                        @error('valor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="concepto_id" class="form-control-label">Concepto</label>
                                        <select class="form-control @error('concepto_id') is-invalid @enderror" id="concepto_id" name="concepto_id">
                                            <option value="">Seleccione un concepto</option>
                                            @foreach($conceptos as $concepto)
                                                <option value="{{ $concepto->concepto_id }}" {{ old('concepto_id', $deposito->concepto_id) == $concepto->concepto_id ? 'selected' : '' }}>
                                                    {{ $concepto->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('concepto_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observaciones" class="form-control-label">Observaciones</label>
                                <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones" rows="3">{{ old('observaciones', $deposito->observaciones) }}</textarea>
                                @error('observaciones')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('depositos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection