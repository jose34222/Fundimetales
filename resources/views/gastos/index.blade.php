@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Gestión de Gastos'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Listado de Gastos</h6>
                        <a href="{{ route('gastos.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Registrar Gasto
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Concepto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Valor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registrado por</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gastos as $gasto)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $gasto->fecha->format('d/m/Y') }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $gasto->concepto->nombre }}</p>
                                        </td>
                                        <td>
                                            <span class="text-danger font-weight-bold">${{ number_format($gasto->valor, 2) }}</span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $gasto->usuario->name }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('gastos.show', $gasto) }}" class="btn btn-link text-info mb-0">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('gastos.edit', $gasto) }}" class="btn btn-link text-secondary mb-0">
                                                <i class="fas fa-pencil-alt text-dark"></i>
                                            </a>
                                            <form action="{{ route('gastos.destroy', $gasto) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger mb-0" onclick="return confirm('¿Estás seguro de eliminar este gasto?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 pt-4">
                            {{ $gastos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection