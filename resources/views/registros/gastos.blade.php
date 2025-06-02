@extends('layouts.app')

@section('title', 'Registros - Gastos')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Registrar Gasto</h2>
</div>

<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link active" href="#">Registrar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Historial</a>
    </li>
</ul>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Registrar Nuevo Gasto</h5>
    </div>
    <div class="card-body">
        <form id="gasto-form">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="gasto-fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="gasto-fecha" required>
                </div>
                <div class="col-md-8">
                    <label for="gasto-concepto" class="form-label">Concepto</label>
                    <input type="text" class="form-control" id="gasto-concepto" placeholder="Descripción del gasto" required>
                </div>
            </div>
            <!-- Más campos del formulario -->
            <button type="submit" class="btn btn-primary">Registrar Gasto</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Historial de Gastos</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="gastos-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Categoría</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gastos as $gasto)
                    <tr data-id="{{ $gasto->id }}">
                        <td>{{ $gasto->fecha->format('d/m/Y') }}</td>
                        <td>{{ $gasto->concepto }}</td>
                        <td>{{ ucfirst($gasto->categoria) }}</td>
                        <td>${{ number_format($gasto->monto, 2) }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary btn-edit" data-type="gasto" data-id="{{ $gasto->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger btn-delete" data-type="gasto" data-id="{{ $gasto->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Scripts específicos para gastos
    document.getElementById('gasto-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            fecha: document.getElementById('gasto-fecha').value,
            concepto: document.getElementById('gasto-concepto').value,
            // Más campos...
            _token: document.querySelector('input[name="_token"]').value
        };
        
        fetch('/registros/gastos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': formData._token
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    });
</script>
@endsection