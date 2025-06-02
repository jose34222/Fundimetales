@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Concepto'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Editar Concepto: {{ $concepto->nombre }}</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('conceptos.update', $concepto) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="form-control-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $concepto->nombre }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_concepto" class="form-control-label">Tipo de Concepto</label>
                                        <select class="form-control" id="tipo_concepto" name="tipo_concepto" required>
                                            <option value="ingreso" {{ $concepto->tipo_concepto == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                                            <option value="egreso" {{ $concepto->tipo_concepto == 'egreso' ? 'selected' : '' }}>Egreso</option>
                                            <option value="transferencia" {{ $concepto->tipo_concepto == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="form-control-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $concepto->descripcion }}</textarea>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('conceptos.index') }}" class="btn btn-light me-3">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection