@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Crear Producto'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Nuevo Producto</h6>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <form action="{{ route('productos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo" class="form-control-label">Código</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="form-control-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="form-control-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categoria_id" class="form-control-label">Categoría</label>
                                        <select class="form-control" id="categoria_id" name="categoria_id" required>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="proveedor_id" class="form-control-label">Proveedor</label>
                                        <select class="form-control" id="proveedor_id" name="proveedor_id">
                                            <option value="">Seleccione un proveedor</option>
                                            @foreach($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="precio_compra" class="form-control-label">Precio Compra</label>
                                        <input type="number" step="0.01" class="form-control" id="precio_compra" name="precio_compra" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="precio_venta" class="form-control-label">Precio Venta</label>
                                        <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="unidad_medida" class="form-control-label">Unidad de Medida</label>
                                        <input type="text" class="form-control" id="unidad_medida" name="unidad_medida">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock_minimo" class="form-control-label">Stock Mínimo</label>
                                        <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection