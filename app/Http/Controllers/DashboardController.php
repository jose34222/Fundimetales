<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use App\Models\Concepto;
use App\Models\CuentaBancaria;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de depósitos
        $totalDepositos = Deposito::sum('valor');
        
        // Variación mensual
        $mesActual = Deposito::whereMonth('fecha', now()->month)->sum('valor');
        $mesAnterior = Deposito::whereMonth('fecha', now()->subMonth()->month)->sum('valor');
        $porcentajeVariacionMensual = $mesAnterior > 0 ? round(($mesActual - $mesAnterior) / $mesAnterior * 100, 2) : 100;
        
        // Cuentas bancarias
        $totalCuentas = CuentaBancaria::count();
        $cuentasNuevas = CuentaBancaria::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        
        // Depósitos hoy
        $depositosHoy = Deposito::whereDate('fecha', today())->sum('valor');
        $cantidadDepositosHoy = Deposito::whereDate('fecha', today())->count();
        
        // Conceptos
        $totalConceptos = Concepto::count();
        $conceptoMasUsado = Deposito::select('concepto_id', DB::raw('count(*) as total'))
            ->groupBy('concepto_id')
            ->orderByDesc('total')
            ->first();
        $conceptoMasUsado = $conceptoMasUsado ? Concepto::find($conceptoMasUsado->concepto_id)->nombre : 'N/A';
        
        // Gráfico de depósitos mensuales
        $depositosMensuales = Deposito::select(
                DB::raw('MONTH(fecha) as mes'),
                DB::raw('SUM(valor) as total')
            )
            ->whereYear('fecha', now()->year)
            ->groupBy(DB::raw('MONTH(fecha)'))
            ->orderBy('mes')
            ->get();
        
        $meses = [];
        $valoresMensuales = array_fill(0, 12, 0);
        
        foreach ($depositosMensuales as $deposito) {
            $nombreMes = Carbon::create()->month($deposito->mes)->locale('es')->monthName;
            $meses[] = ucfirst($nombreMes);
            $valoresMensuales[$deposito->mes - 1] = $deposito->total;
        }
        
        // Crecimiento anual
        $inicioAno = Deposito::whereYear('fecha', now()->year)
            ->whereMonth('fecha', 1)
            ->sum('valor');
        $porcentajeCrecimientoAnual = $inicioAno > 0 ? round(($mesActual - $inicioAno) / $inicioAno * 100, 2) : 100;
        
        // Últimos depósitos
        $ultimosDepositos = Deposito::with(['cuenta', 'concepto'])
            ->orderBy('fecha', 'desc')
            ->limit(5)
            ->get();
        
        // Depósitos por cuenta
        $depositosPorCuenta = CuentaBancaria::select('cuentas_bancarias.*')
            ->selectRaw('COUNT(depositos.id) as total_depositos')
            ->selectRaw('SUM(depositos.valor) as total_valor')
            ->selectRaw('AVG(depositos.valor) as promedio_valor')
            ->leftJoin('depositos', 'cuentas_bancarias.cuenta_id', '=', 'depositos.cuenta_id')
            ->groupBy('cuentas_bancarias.cuenta_id')
            ->orderByDesc('total_valor')
            ->get();
        
        // Depósitos por concepto
        $depositosPorConcepto = Concepto::select('conceptos.*')
            ->selectRaw('SUM(depositos.valor) as total_valor')
            ->leftJoin('depositos', 'conceptos.concepto_id', '=', 'depositos.concepto_id')
            ->groupBy('conceptos.concepto_id')
            ->orderByDesc('total_valor')
            ->get();
        
        // Datos para gráfico de conceptos
        $conceptosLabels = $depositosPorConcepto->pluck('nombre')->toArray();
        $conceptosData = $depositosPorConcepto->pluck('total_valor')->toArray();
        
        // Colores para los gráficos
        $colors = ['primary', 'secondary', 'info', 'success', 'warning', 'danger', 'dark'];
        $conceptosColors = array_map(function($color) {
            return getThemeColor($color);
        }, array_slice($colors, 0, count($conceptosLabels)));
        
        return view('dashboard', compact(
            'totalDepositos',
            'porcentajeVariacionMensual',
            'totalCuentas',
            'cuentasNuevas',
            'depositosHoy',
            'cantidadDepositosHoy',
            'totalConceptos',
            'conceptoMasUsado',
            'meses',
            'valoresMensuales',
            'porcentajeCrecimientoAnual',
            'ultimosDepositos',
            'depositosPorCuenta',
            'depositosPorConcepto',
            'conceptosLabels',
            'conceptosData',
            'conceptosColors',
            'colors'
        ));
    }
    
    // Función auxiliar para obtener colores del tema
    private function getThemeColor($color)
    {
        $colors = [
            'primary' => '#5e72e4',
            'secondary' => '#8392ab',
            'info' => '#11cdef',
            'success' => '#2dce89',
            'warning' => '#fb6340',
            'danger' => '#f5365c',
            'dark' => '#172b4d'
        ];
        
        return $colors[$color] ?? '#5e72e4';
    }
}