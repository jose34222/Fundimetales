@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Movimientos de Inventario'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Todos los Movimientos</h6>
                        <div>
                            <a href="{{ route('movimientos.resumen') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-boxes"></i> Resumen Inventario
                            </a>
                            <a href="{{ route('movimientos.bajo-stock') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-exclamation-triangle"></i> Bajo Stock
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row px-4">
                            <div class="col-md-12">
                                <form action="{{ route('movimientos.por-fecha') }}" method="GET" class="row g-3">
                                    @csrf
                                    <div class="col-md-4">
                                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cantidad</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Precio Unitario</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documento</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimientos as $movimiento)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($movimiento->fecha)->format('d/m/Y') }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $movimiento->producto->nombre }}</p>
                                        </td>
                                        <td>
                                            @if($movimiento->tipo == 'entrada')
                                                <span class="badge bg-success">Entrada</span>
                                            @elseif($movimiento->tipo == 'salida')
                                                <span class="badge bg-danger">Salida</span>
                                            @elseif($movimiento->tipo == 'ajuste_entrada')
                                                <span class="badge bg-warning">Ajuste +</span>
                                            @else
                                                <span class="badge bg-warning">Ajuste -</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $movimiento->cantidad }} {{ $movimiento->producto->unidad_medida }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">${{ number_format($movimiento->precio_unitario, 2) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">${{ number_format($movimiento->total, 2) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $movimiento->documento }} {{ $movimiento->numero_documento }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $movimiento->usuario->name }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('movimientos.por-producto', $movimiento->producto_id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Ver Producto">
                                                <i class="fas fa-box"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 pt-4">
                            Link
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script>
        // Establecer fechas por defecto (últimos 30 días)
        document.addEventListener('DOMContentLoaded', function() {
            const fechaFin = new Date();
            const fechaInicio = new Date();
            fechaInicio.setDate(fechaInicio.getDate() - 30);
            
            document.getElementById('fecha_inicio').valueAsDate = fechaInicio;
            document.getElementById('fecha_fin').valueAsDate = fechaFin;
        });
    </script>
@endpush