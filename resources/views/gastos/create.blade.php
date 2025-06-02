@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Registrar Gasto'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Nuevo Gasto</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('gastos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha" class="form-control-label">Fecha</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', now()->format('Y-m-d')) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="concepto_id" class="form-control-label">Concepto</label>
                                        <select class="form-control" id="concepto_id" name="concepto_id" required>
                                            <option value="">Seleccione un concepto</option>
                                            @foreach($conceptos as $concepto)
                                                <option value="{{ $concepto->id }}" {{ old('concepto_id') == $concepto->id ? 'selected' : '' }}>
                                                    {{ $concepto->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="valor" class="form-control-label">Valor</label>
                                        <input type="number" step="0.01" class="form-control" id="valor" name="valor" value="{{ old('valor') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detalles" class="form-control-label">Detalles</label>
                                <textarea class="form-control" id="detalles" name="detalles" rows="3">{{ old('detalles') }}</textarea>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('gastos.index') }}" class="btn btn-light me-3">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar Gasto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection