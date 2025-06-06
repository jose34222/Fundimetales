@extends('layouts.app', ['title' => 'Editar Venta'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Editar Venta #{{ $venta->id }}</h4>
                        <p class="card-category">Modifique los campos necesarios</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ventas.update', $venta->id) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Fecha</label>
                                        <input type="date" class="form-control" name="fecha" value="{{ old('fecha', $venta->fecha->format('Y-m-d')) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Cliente</label>
                                        <select class="form-control" name="cliente_id" required>
                                            @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Concepto</label>
                                        <select class="form-control" name="concepto_id" required>
                                            @foreach($conceptos as $concepto)
                                                <option value="{{ $concepto->id }}" {{ $venta->concepto_id == $concepto->id ? 'selected' : '' }}>
                                                    {{ $concepto->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Cuenta Bancaria</label>
                                        <select class="form-control" name="cuenta_id">
                                            <option value="">Seleccione una cuenta</option>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->id }}" {{ $venta->cuenta_id == $cuenta->id ? 'selected' : '' }}>
                                                    {{ $cuenta->nombre }} ({{ $cuenta->numero }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="title">Productos</h4>
                                    <div id="productos-container">
                                        @foreach($venta->productos as $index => $producto)
                                        <div class="row producto-item mt-2">
                                            <div class="col-md-4">
                                                <select class="form-control producto-select" name="productos[{{ $index }}][id]">
                                                    @foreach($productos as $prod)
                                                        <option value="{{ $prod->id }}" data-precio="{{ $prod->precio_venta }}" 
                                                            {{ $producto->id == $prod->id ? 'selected' : '' }}>
                                                            {{ $prod->nombre }} (Stock: {{ $prod->stock }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control cantidad" name="productos[{{ $index }}][cantidad]" 
                                                       value="{{ $producto->pivot->cantidad }}" min="1">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" step="0.01" class="form-control precio" name="productos[{{ $index }}][precio]" 
                                                       value="{{ $producto->pivot->precio_unitario }}" min="0">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control subtotal" 
                                                       value="{{ number_format($producto->pivot->subtotal, 2) }}" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-producto">Eliminar</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-producto" class="btn btn-info btn-sm mt-2">
                                        <i class="material-icons">add</i> Agregar Producto
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h4 class="title">Servicios</h4>
                                    <div id="servicios-container">
                                        @foreach($venta->servicios as $index => $servicio)
                                        <div class="row servicio-item mt-2">
                                            <div class="col-md-4">
                                                <select class="form-control servicio-select" name="servicios[{{ $index }}][id]">
                                                    @foreach($servicios as $serv)
                                                        <option value="{{ $serv->id }}" data-precio="{{ $serv->precio }}" 
                                                            {{ $servicio->id == $serv->id ? 'selected' : '' }}>
                                                            {{ $serv->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control cantidad" name="servicios[{{ $index }}][cantidad]" 
                                                       value="{{ $servicio->pivot->cantidad }}" min="1">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" step="0.01" class="form-control precio" name="servicios[{{ $index }}][precio]" 
                                                       value="{{ $servicio->pivot->precio_unitario }}" min="0">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control subtotal" 
                                                       value="{{ number_format($servicio->pivot->subtotal, 2) }}" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-servicio">Eliminar</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-servicio" class="btn btn-info btn-sm mt-2">
                                        <i class="material-icons">add</i> Agregar Servicio
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Valor Total</label>
                                        <input type="number" step="0.01" class="form-control" name="valor" id="valor-total" 
                                               value="{{ old('valor', $venta->valor) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Observaciones</label>
                                        <input type="text" class="form-control" name="observaciones" 
                                               value="{{ old('observaciones', $venta->observaciones) }}">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary pull-right">Actualizar Venta</button>
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-default">Cancelar</a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// El mismo script de la vista create para manejar la dinámica de productos y servicios
$(document).ready(function() {
    let productoCounter = {{ $venta->productos->count() }};
    let servicioCounter = {{ $venta->servicios->count() }};
    
    $('#add-producto').click(function() {
        const newItem = $(`<div class="row producto-item mt-2">
            <div class="col-md-4">
                <select class="form-control producto-select" name="productos[${productoCounter}][id]">
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_venta }}">
                            {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control cantidad" name="productos[${productoCounter}][cantidad]" placeholder="Cantidad" min="1" value="1">
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" class="form-control precio" name="productos[${productoCounter}][precio]" placeholder="Precio" min="0">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control subtotal" placeholder="Subtotal" readonly>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-producto">Eliminar</button>
            </div>
        </div>`);
        
        $('#productos-container').append(newItem);
        productoCounter++;
    });
    
    $('#add-servicio').click(function() {
        const newItem = $(`<div class="row servicio-item mt-2">
            <div class="col-md-4">
                <select class="form-control servicio-select" name="servicios[${servicioCounter}][id]">
                    <option value="">Seleccione un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">
                            {{ $servicio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control cantidad" name="servicios[${servicioCounter}][cantidad]" placeholder="Cantidad" min="1" value="1">
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" class="form-control precio" name="servicios[${servicioCounter}][precio]" placeholder="Precio" min="0">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control subtotal" placeholder="Subtotal" readonly>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-servicio">Eliminar</button>
            </div>
        </div>`);
        
        $('#servicios-container').append(newItem);
        servicioCounter++;
    });
    
    $(document).on('click', '.remove-producto', function() {
        $(this).closest('.producto-item').remove();
        calcularTotal();
    });
    
    $(document).on('click', '.remove-servicio', function() {
        $(this).closest('.servicio-item').remove();
        calcularTotal();
    });
    
    $(document).on('change', '.producto-select, .servicio-select', function() {
        const precio = $(this).find(':selected').data('precio');
        $(this).closest('.row').find('.precio').val(precio);
        calcularSubtotal($(this).closest('.row'));
        calcularTotal();
    });
    
    $(document).on('input', '.cantidad, .precio', function() {
        calcularSubtotal($(this).closest('.row'));
        calcularTotal();
    });
    
    function calcularSubtotal(row) {
        const cantidad = parseFloat(row.find('.cantidad').val()) || 0;
        const precio = parseFloat(row.find('.precio').val()) || 0;
        const subtotal = cantidad * precio;
        row.find('.subtotal').val(subtotal.toFixed(2));
    }
    
    function calcularTotal() {
        let total = 0;
        
        $('.producto-item, .servicio-item').each(function() {
            const subtotal = parseFloat($(this).find('.subtotal').val()) || 0;
            total += subtotal;
        });
        
        $('#valor-total').val(total.toFixed(2));
    }
    
    // Inicializar cálculos
    $('.producto-item, .servicio-item').each(function() {
        calcularSubtotal($(this));
    });
    calcularTotal();
});
</script>
@endpush
@endsection