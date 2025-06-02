@extends('layouts.app', ['activePage' => 'clientes', 'titlePage' => __('Editar Cliente')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('clientes.update', $cliente->id) }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Editar Cliente') }}</h4>
                            <p class="card-category">{{ __('Modifique los datos del cliente') }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="nombre">{{ __('Nombre') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" 
                                               name="nombre" id="nombre" type="text" 
                                               placeholder="{{ __('Nombre completo') }}" 
                                               value="{{ old('nombre', $cliente->nombre) }}" required />
                                        @if ($errors->has('nombre'))
                                        <span id="nombre-error" class="error text-danger" for="nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="identificacion">{{ __('Identificación') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('identificacion') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('identificacion') ? ' is-invalid' : '' }}" 
                                               name="identificacion" id="identificacion" type="text" 
                                               placeholder="{{ __('Número de identificación') }}" 
                                               value="{{ old('identificacion', $cliente->identificacion) }}" required />
                                        @if ($errors->has('identificacion'))
                                        <span id="identificacion-error" class="error text-danger" for="identificacion">{{ $errors->first('identificacion') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="tipo_cliente">{{ __('Tipo de Cliente') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('tipo_cliente') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('tipo_cliente') ? ' is-invalid' : '' }}" 
                                                name="tipo_cliente" id="tipo_cliente" required>
                                            <option value="">{{ __('Seleccione un tipo') }}</option>
                                            <option value="Persona Natural" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'Persona Natural' ? 'selected' : '' }}>Persona Natural</option>
                                            <option value="Persona Jurídica" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'Persona Jurídica' ? 'selected' : '' }}>Persona Jurídica</option>
                                            <option value="Gobierno" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'Gobierno' ? 'selected' : '' }}>Gobierno</option>
                                        </select>
                                        @if ($errors->has('tipo_cliente'))
                                        <span id="tipo_cliente-error" class="error text-danger" for="tipo_cliente">{{ $errors->first('tipo_cliente') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-default">{{ __('Cancelar') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection