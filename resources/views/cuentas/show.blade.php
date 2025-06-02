@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalles de Cuenta Bancaria'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Detalles de la Cuenta Bancaria</h6>
                            <div>
                                <a href="{{ route('cuentas.edit', $cuenta->cuenta_id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="{{ route('cuentas.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Número de Cuenta</label>
                                    <p class="form-control-static">{{ $cuenta->numero_cuenta }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Banco</label>
                                    <p class="form-control-static">{{ $cuenta->banco }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Tipo de Cuenta</label>
                                    <p class="form-control-static">{{ $cuenta->tipo_cuenta }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Fecha de Creación</label>
                                    <p class="form-control-static">{{ $cuenta->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Última Actualización</label>
                                    <p class="form-control-static">{{ $cuenta->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección de relaciones (opcional) -->
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Operaciones Relacionadas</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="ventas-tab" data-bs-toggle="tab" data-bs-target="#ventas" type="button" role="tab" aria-controls="ventas" aria-selected="true">
                                    Ventas ({{ $cuenta->ventas->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="envios-tab" data-bs-toggle="tab" data-bs-target="#envios" type="button" role="tab" aria-controls="envios" aria-selected="false">
                                    Envíos ({{ $cuenta->envios->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="depositos-tab" data-bs-toggle="tab" data-bs-target="#depositos" type="button" role="tab" aria-controls="depositos" aria-selected="false">
                                    Depósitos ({{ $cuenta->depositos->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="cheques-tab" data-bs-toggle="tab" data-bs-target="#cheques" type="button" role="tab" aria-controls="cheques" aria-selected="false">
                                    Cheques ({{ $cuenta->cheques->count() }})
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="ventas" role="tabpanel" aria-labelledby="ventas-tab">
                                @include('cuentas.partials.ventas-table', ['ventas' => $cuenta->ventas])
                            </div>
                            <div class="tab-pane fade" id="envios" role="tabpanel" aria-labelledby="envios-tab">
                                @include('cuentas.partials.envios-table', ['envios' => $cuenta->envios])
                            </div>
                            <div class="tab-pane fade" id="depositos" role="tabpanel" aria-labelledby="depositos-tab">
                                @include('cuentas.partials.depositos-table', ['depositos' => $cuenta->depositos])
                            </div>
                            <div class="tab-pane fade" id="cheques" role="tabpanel" aria-labelledby="cheques-tab">
                                @include('cuentas.partials.cheques-table', ['cheques' => $cuenta->cheques])
                            </div>
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
        // Inicializar tabs de Bootstrap
        var tabElms = [].slice.call(document.querySelectorAll('button[data-bs-toggle="tab"]'));
        tabElms.forEach(function(tabElm) {
            new bootstrap.Tab(tabElm);
        });
    </script>
@endpush