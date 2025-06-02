@extends('layouts.app', ['activePage' => 'clientes', 'titlePage' => __('Detalles del Cliente')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Detalles del Cliente') }}</h4>
                        <p class="card-category">{{ __('Información completa del cliente') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('ID') }}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $cliente->id }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $cliente->nombre }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Identificación') }}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $cliente->identificacion }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Tipo de Cliente') }}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $cliente->tipo_cliente }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Fecha de Creación') }}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $cliente->created_at->format('d/m/Y H:i') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Última Actualización') }}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $cliente->updated_at->format('d/m/Y H:i') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <a href="{{ route('clientes.index') }}" class="btn btn-default">{{ __('Volver') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection