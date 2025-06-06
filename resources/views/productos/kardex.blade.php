@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kardex de Producto'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Kardex: {{ $producto->nombre }}</h6>
                        <div>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#entradaModal">
                                <i class="fas fa-plus"></i> Entrada
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ajusteModal">
                                <i class="fas fa-adjust"></i> Ajuste
                            </button>
                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row px-4">
                            <div class="col-md-4">
                                <p><strong>Código:</strong> {{ $producto->codigo }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Stock Actual:</strong> {{ $producto->stock_actual }} {{ $producto->unidad_medida }}</p>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cantidad</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Precio Unitario</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documento</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimientos as $movimiento)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($movimiento->fecha)->format('d/m/Y') }}</p>
                                        </td>
                                        <td>
                                            @if($movimiento->tipo == 'entrada')
                                                <span class="badge bg-success">Entrada</span>
                                            @elseif($movimiento->tipo == 'salida')
                                                <span class="badge bg-danger">Salida</span>
                                            @elseif($movimiento->tipo == 'ajuste_entrada')
                                                <span class="badge bg-warning">Ajuste Entrada</span>
                                            @else
                                                <span class="badge bg-warning">Ajuste Salida</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $movimiento->cantidad }}</p>
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
                                            <p class="text-xs font-weight-bold mb-0">{{ $movimiento->usuario->name ?? 'N/A' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $movimiento->observaciones }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 pt-4">
                            {{ $movimientos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>

    <!-- Modal Entrada -->
    <div class="modal fade" id="entradaModal" tabindex="-1" aria-labelledby="entradaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entradaModalLabel">Registrar Entrada de Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('productos.entradaInventario', $producto->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha" class="form-control-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="cantidad" class="form-control-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="precio_unitario" class="form-control-label">Precio Unitario</label>
                            <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" min="0" required value="{{ $producto->precio_compra }}">
                        </div>
                        <div class="form-group">
                            <label for="documento" class="form-control-label">Tipo Documento</label>
                            <input type="text" class="form-control" id="documento" name="documento" placeholder="Ej: Factura, Remisión">
                        </div>
                        <div class="form-group">
                            <label for="numero_documento" class="form-control-label">Número Documento</label>
                            <input type="text" class="form-control" id="numero_documento" name="numero_documento">
                        </div>
                        <div class="form-group">
                            <label for="observaciones" class="form-control-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ajuste -->
    <div class="modal fade" id="ajusteModal" tabindex="-1" aria-labelledby="ajusteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajusteModalLabel">Ajuste de Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('productos.ajusteInventario', $producto->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha_ajuste" class="form-control-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha_ajuste" name="fecha" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="cantidad_ajuste" class="form-control-label">Nuevo Stock</label>
                            <input type="number" class="form-control" id="cantidad_ajuste" name="cantidad" required value="{{ $producto->stock_actual }}">
                        </div>
                        <div class="form-group">
                            <label for="observaciones_ajuste" class="form-control-label">Motivo del Ajuste</label>
                            <textarea class="form-control" id="observaciones_ajuste" name="observaciones" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aplicar Ajuste</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Inicializar modales
        var entradaModal = new bootstrap.Modal(document.getElementById('entradaModal'));
        var ajusteModal = new bootstrap.Modal(document.getElementById('ajusteModal'));
    </script>
@endpush