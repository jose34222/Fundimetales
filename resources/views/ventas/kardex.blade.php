@extends('layouts.app', ['title' => 'Kardex de Producto'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Kardex de Producto: {{ $producto->nombre }}</h4>
                        <p class="card-category">Movimientos de inventario</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Información del Producto</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Código:</th>
                                        <td>{{ $producto->codigo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nombre:</th>
                                        <td>{{ $producto->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stock Actual:</th>
                                        <td>{{ $producto->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th>Precio Compra:</th>
                                        <td>${{ number_format($producto->precio_compra, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Precio Venta:</th>
                                        <td>${{ number_format($producto->precio_venta, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="col-md-6">
                                <h5>Resumen de Movimientos</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Total Entradas:</th>
                                        <td>{{ $movimientos->where('tipo', 'entrada')->sum('cantidad') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Salidas:</th>
                                        <td>{{ $movimientos->where('tipo', 'salida')->sum('cantidad') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor Total Entradas:</th>
                                        <td>${{ number_format($movimientos->where('tipo', 'entrada')->sum('total'), 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor Total Salidas:</th>
                                        <td>${{ number_format($movimientos->where('tipo', 'salida')->sum('total'), 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Detalle de Movimientos</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Tipo</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unit.</th>
                                                <th>Total</th>
                                                <th>Documento</th>
                                                <th>N° Documento</th>
                                                <th>Usuario</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($movimientos as $movimiento)
                                            <tr>
                                                <td>{{ $movimiento->fecha->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $movimiento->tipo == 'entrada' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($movimiento->tipo) }}
                                                    </span>
                                                </td>
                                                <td>{{ $movimiento->cantidad }}</td>
                                                <td>${{ number_format($movimiento->precio_unitario, 2) }}</td>
                                                <td>${{ number_format($movimiento->total, 2) }}</td>
                                                <td>{{ $movimiento->documento }}</td>
                                                <td>{{ $movimiento->numero_documento }}</td>
                                                <td>{{ $movimiento->usuario->name }}</td>
                                                <td>{{ $movimiento->observaciones }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $movimientos->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <a href="{{ route('ventas.index') }}" class="btn btn-default">
                                    <i class="material-icons">arrow_back</i> Volver a Ventas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection