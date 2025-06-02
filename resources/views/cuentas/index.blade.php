@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Listado de Cuentas Bancarias</h6>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cuentas.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Nueva Cuenta
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Número de Cuenta</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banco</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Cuenta</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuentas as $cuenta)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 px-3">{{ $cuenta->numero_cuenta }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 px-3">{{ $cuenta->banco }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 px-3">{{ $cuenta->tipo_cuenta }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex px-3">
                                            <a href="{{ route('cuentas.edit', ['cuenta' => $cuenta->id]) }}"
                                            class="btn btn-link text-info px-3 mb-0">
                                                    <i class="fas fa-pencil-alt text-info me-2"></i>Editar
                                                </a>
                                                <form action="{{ route('cuentas.destroy', ['cuenta' => $cuenta->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger px-3 mb-0" onclick="return confirm('¿Estás seguro de eliminar esta cuenta?')">
                                                        <i class="far fa-trash-alt me-2"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 pt-4">
                            {!! $cuentas->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
@endsection