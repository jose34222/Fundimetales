@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Productos con Bajo Stock'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Productos con Stock por debajo del mínimo</h6>
                        <div>
                            <a href="{{ route('movimientos.resumen') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-boxes"></i> Ver Todo
                            </a>
                            <a href="{{ route('movimientos.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Categoría</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock Actual</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock Mínimo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diferencia</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proveedor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $producto->nombre }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $producto->codigo }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $producto->categoria->nombre ?? 'N/A' }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold text-danger">{{ $producto->stock_actual }} {{ $producto->unidad_medida }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold">{{ $producto->stock_minimo }} {{ $producto->unidad_medida }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold text-danger">{{ $producto->stock_actual - $producto->stock_minimo }} {{ $producto->unidad_medida }}</span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $producto->proveedor->nombre ?? 'N/A' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $producto->proveedor->telefono ?? 'N/A' }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('productos.kardex', $producto->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Registrar Entrada">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                            <a href="tel:{{ $producto->proveedor->telefono ?? '' }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Llamar Proveedor">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 pt-4">
                            {{ $productos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection