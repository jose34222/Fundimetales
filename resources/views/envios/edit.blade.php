@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Envío'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Editar Envío</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('envios.update', $envio->envio_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha" class="form-control-label">Fecha</label>
                                        <input class="form-control" type="date" id="fecha" name="fecha" value="{{ $envio->fecha->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="referencia" class="form-control-label">Referencia</label>
                                        <input class="form-control" type="text" id="referencia" name="referencia" value="{{ $envio->referencia }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cliente_id" class="form-control-label">Cliente</label>
                                        <select class="form-control" id="cliente_id" name="cliente_id">
                                            <option value="">Seleccione un cliente</option>
                                            @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->cliente_id }}" {{ $envio->cliente_id == $cliente->cliente_id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cuenta_id" class="form-control-label">Cuenta Bancaria</label>
                                        <select class="form-control" id="cuenta_id" name="cuenta_id">
                                            <option value="">Seleccione una cuenta</option>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->cuenta_id }}" {{ $envio->cuenta_id == $cuenta->cuenta_id ? 'selected' : '' }}>{{ $cuenta->banco }} - {{ $cuenta->numero_cuenta }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lugar" class="form-control-label">Lugar</label>
                                        <input class="form-control" type="text" id="lugar" name="lugar" value="{{ $envio->lugar }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="valor" class="form-control-label">Valor</label>
                                        <input class="form-control" type="number" step="0.01" id="valor" name="valor" value="{{ $envio->valor }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="autoriza" class="form-control-label">Autoriza</label>
                                        <input class="form-control" type="text" id="autoriza" name="autoriza" value="{{ $envio->autoriza }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="observaciones" class="form-control-label">Observaciones</label>
                                        <input class="form-control" type="text" id="observaciones" name="observaciones" value="{{ $envio->observaciones }}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('envios.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection