@extends('layouts.app', ['title' => 'Editar Cheque'])

@section('content')


<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Editar Cheque #{{ $cheque->numero_cheque }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('cheques.index') }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="post" action="{{ route('cheques.update', $cheque) }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('numero_cheque') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="numero_cheque">Número de Cheque</label>
                                <input type="text" name="numero_cheque" id="numero_cheque" class="form-control form-control-alternative{{ $errors->has('numero_cheque') ? ' is-invalid' : '' }}" placeholder="Número de cheque" value="{{ old('numero_cheque', $cheque->numero_cheque) }}" required>
                                @if ($errors->has('numero_cheque'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('numero_cheque') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('banco') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="banco">Banco</label>
                                        <input type="text" name="banco" id="banco" class="form-control form-control-alternative{{ $errors->has('banco') ? ' is-invalid' : '' }}" placeholder="Nombre del banco" value="{{ old('banco', $cheque->banco) }}" required>
                                        @if ($errors->has('banco'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('banco') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('fecha') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="fecha">Fecha</label>
                                        <input type="date" name="fecha" id="fecha" class="form-control form-control-alternative{{ $errors->has('fecha') ? ' is-invalid' : '' }}" value="{{ old('fecha', $cheque->fecha ? \Carbon\Carbon::parse($cheque->fecha)->format('Y-m-d') : '') }}" required>
                                        @if ($errors->has('fecha'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fecha') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('valor') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="valor">Valor</label>
                                        <input type="number" step="0.01" name="valor" id="valor" class="form-control form-control-alternative{{ $errors->has('valor') ? ' is-invalid' : '' }}" placeholder="0.00" value="{{ old('valor', $cheque->valor) }}" required>
                                        @if ($errors->has('valor'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('valor') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('cuenta_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="cuenta_id">Cuenta Bancaria</label>
                                        <select name="cuenta_id" id="cuenta_id" class="form-control form-control-alternative{{ $errors->has('cuenta_id') ? ' is-invalid' : '' }}">
                                            <option value="">Seleccione una cuenta</option>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->cuenta_id }}" {{ old('cuenta_id', $cheque->cuenta_id) == $cuenta->cuenta_id ? 'selected' : '' }}>{{ $cuenta->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cuenta_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cuenta_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('observaciones') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="observaciones">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" class="form-control form-control-alternative{{ $errors->has('observaciones') ? ' is-invalid' : '' }}" rows="3">{{ old('observaciones', $cheque->observaciones) }}</textarea>
                                @if ($errors->has('observaciones'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('observaciones') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection