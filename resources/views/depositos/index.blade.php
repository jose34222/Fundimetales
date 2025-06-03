@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Depósitos'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Listado de Depósitos</h6>
                        <a href="{{ route('depositos.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nuevo Depósito
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cuenta</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Valor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Concepto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($depositos as $deposito)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($deposito->fecha)->format('d/m/Y') }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $deposito->cuenta->numero_cuenta }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">${{ number_format($deposito->valor, 2) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $deposito->concepto->nombre ?? 'N/A' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $deposito->usuario->firstname }} {{ $deposito->usuario->lastname }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('depositos.show', $deposito) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('depositos.edit', $deposito) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('depositos.destroy', $deposito) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este depósito?')">
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
                            {{ $depositos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script>
        // Inicializar tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush