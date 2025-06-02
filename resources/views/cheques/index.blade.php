@extends('layouts.app', ['title' => 'Gestión de Cheques'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Cheques</h4>
                        <p class="card-category">Listado de cheques registrados</p>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('success') }}</span>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('cheques.create') }}" class="btn btn-sm btn-primary">
                                    <i class="material-icons">add</i> Nuevo Cheque
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th>N° Cheque</th>
                                        <th>Banco</th>
                                        <th>Valor</th>
                                        <th>Fecha</th>
                                        <th>Cuenta</th>
                                        <th>Usuario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cheques as $cheque)
                                    <tr>
                                        <td>{{ $cheque->numero_cheque }}</td>
                                        <td>{{ $cheque->banco }}</td>
                                        <td>${{ number_format($cheque->valor, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cheque->fecha)->format('d/m/Y') }}</td>
                                        <td>{{ $cheque->cuenta->nombre ?? 'Sin cuenta' }}</td>
                                        <td>{{ $cheque->usuario->name }}</td>
                                        <td class="td-actions text-right">
                                            <a rel="tooltip" class="btn btn-info btn-link" 
                                               href="{{ route('cheques.show', $cheque->id) }}" 
                                               data-original-title="" title="">
                                                <i class="material-icons">visibility</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <a rel="tooltip" class="btn btn-success btn-link" 
                                               href="{{ route('cheques.edit', $cheque->id) }}" 
                                               data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <form action="{{ route('cheques.destroy', $cheque->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" rel="tooltip" class="btn btn-danger btn-link" 
                                                        data-original-title="" title=""
                                                        onclick="return confirm('¿Estás seguro de eliminar este cheque?')">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $cheques->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection