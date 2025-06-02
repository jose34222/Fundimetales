@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Ventas</h3>
                        <div class="card-tools">
                            <a href="{{ route('ventas.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Nueva Venta
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Concepto</th>
                                    <th>Valor</th>
                                    <th>Cuenta</th>
                                    <th>Registrado por</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td>{{ $venta->id }}</td>
                                        <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                                        <td>{{ $venta->cliente->nombre }}</td>
                                        <td>{{ $venta->concepto->nombre }}</td>
                                        <td>${{ number_format($venta->valor, 2) }}</td>
                                        <td>{{ $venta->cuenta ? $venta->cuenta->nombre : 'N/A' }}</td>
                                        <td>{{ $venta->usuario->name }}</td>
                                        <td>
                                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta venta?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $ventas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection