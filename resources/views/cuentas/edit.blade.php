@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Cuenta Bancaria'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Editar Cuenta Bancaria</h6>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <form action="{{ route('cuentas.update', $cuenta->cuenta_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numero_cuenta" class="form-control-label">Número de Cuenta</label>
                                        <input type="text" class="form-control @error('numero_cuenta') is-invalid @enderror" 
                                               id="numero_cuenta" name="numero_cuenta" value="{{ old('numero_cuenta', $cuenta->numero_cuenta) }}" required>
                                        @error('numero_cuenta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="banco" class="form-control-label">Banco</label>
                                        <input type="text" class="form-control @error('banco') is-invalid @enderror" 
                                               id="banco" name="banco" value="{{ old('banco', $cuenta->banco) }}" required>
                                        @error('banco')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_cuenta" class="form-control-label">Tipo de Cuenta</label>
                                        <input type="text" class="form-control @error('tipo_cuenta') is-invalid @enderror" 
                                               id="tipo_cuenta" name="tipo_cuenta" value="{{ old('tipo_cuenta', $cuenta->tipo_cuenta) }}" required>
                                        @error('tipo_cuenta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <a href="{{ route('cuentas.index') }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection