@extends('layouts.app', ['title' => 'Detalles de Venta'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Detalles de Venta #{{ $venta->id }}</h4>
                        <p class="card-category">Información completa de la venta</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Información Básica</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Fecha:</th>
                                        <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cliente:</th>
                                        <td>{{ $venta->cliente->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Concepto:</th>
                                        <td>{{ $venta->concepto->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cuenta Bancaria:</th>
                                        <td>{{ $venta->cuenta ? $venta->cuenta->nombre.' ('.$venta->cuenta->numero.')' : 'No especificada' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor Total:</th>
                                        <td class="text-success font-weight-bold">${{ number_format($venta->valor, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registrado por:</th>
                                        <td>{{ $venta->usuario->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Observaciones:</th>
                                        <td>{{ $venta->observaciones ?? 'Ninguna' }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Productos Vendidos</h5>
                                        @if($venta->productos->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio Unit.</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($venta->productos as $producto)
                                                    <tr>
                                                        <td>{{ $producto->nombre }}</td>
                                                        <td>{{ $producto->pivot->cantidad }}</td>
                                                        <td>${{ number_format($producto->pivot->precio_unitario, 2) }}</td>
                                                        <td>${{ number_format($producto->pivot->subtotal, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <div class="alert alert-info">
                                            No hay productos asociados a esta venta.
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <h5>Servicios Vendidos</h5>
                                        @if($venta->servicios->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Servicio</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio Unit.</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($venta->servicios as $servicio)
                                                    <tr>
                                                        <td>{{ $servicio->nombre }}</td>
                                                        <td>{{ $servicio->pivot->cantidad }}</td>
                                                        <td>${{ number_format($servicio->pivot->precio_unitario, 2) }}</td>
                                                        <td>${{ number_format($servicio->pivot->subtotal, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <div class="alert alert-info">
                                            No hay servicios asociados a esta venta.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-success">
                                    <i class="material-icons">edit</i> Editar
                                </a>
                                <a href="{{ route('ventas.index') }}" class="btn btn-default">
                                    <i class="material-icons">arrow_back</i> Volver
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