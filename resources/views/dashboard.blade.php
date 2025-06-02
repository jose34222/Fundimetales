@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Dashboard</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="me-2">
            <span id="current-date">{{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</span>
        </div>
        <div class="dropdown">
            <img src="" 
                 class="rounded-circle" width="32" height="32" alt="Usuario">
        </div>
    </div>
</div>

<!-- Estadísticas -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ventas del Mes</h5>
                <p class="card-text display-6" id="sales-month">$0</p>
                <div class="text-success small">
                    <i class="fas fa-arrow-up"></i>
                    <span>0% vs mes anterior</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Más tarjetas de estadísticas -->
</div>

<!-- Gráficos y tablas -->
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Ventas Mensuales</h5>
                <div class="dropdown">
                    <i class="fas fa-ellipsis-h" data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Exportar</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-placeholder bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                    Gráfico de ventas mensuales (se mostraría aquí)
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Scripts específicos del dashboard
    document.addEventListener('DOMContentLoaded', function() {
        // Cargar datos del dashboard
        updateDashboardStats();
    });
    
    function updateDashboardStats() {
        // Implementar llamada AJAX para obtener datos reales
        fetch('/api/dashboard/stats')
            .then(response => response.json())
            .then(data => {
                document.getElementById('sales-month').textContent = `$${data.sales_month.toFixed(2)}`;
                // Actualizar más estadísticas...
            });
    }
</script>
@endsection