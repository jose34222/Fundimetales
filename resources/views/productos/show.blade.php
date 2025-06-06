@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalle de Producto'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Detalle del Producto</h6>
                        <div>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('productos.kardex', $producto->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-list-alt"></i> Ver Kardex
                            </a>
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-sm">Información Básica</h6>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Código:</strong> {{ $producto->codigo }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Nombre:</strong> {{ $producto->nombre }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Descripción:</strong> {{ $producto->descripcion ?? 'N/A' }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Categoría:</strong> {{ $producto->categoria->nombre ?? 'N/A' }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Proveedor:</strong> {{ $producto->proveedor->nombre ?? 'N/A' }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-sm">Información de Inventario</h6>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Precio Compra:</strong> ${{ number_format($producto->precio_compra, 2) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Precio Venta:</strong> ${{ number_format($producto->precio_venta, 2) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Stock Actual:</strong> {{ $producto->stock_actual }} {{ $producto->unidad_medida }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Stock Mínimo:</strong> {{ $producto->stock_minimo ?? '0' }} {{ $producto->unidad_medida }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Unidad de Medida:</strong> {{ $producto->unidad_medida ?? 'N/A' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection