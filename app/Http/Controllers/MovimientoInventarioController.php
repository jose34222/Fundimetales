<?php

namespace App\Http\Controllers;

use App\Models\MovimientoInventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class MovimientoInventarioController extends Controller
{
    public function index()
    {
        $movimientos = MovimientoInventario::with(['producto', 'usuario'])
            ->orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('movimientos.index', compact('movimientos'));
    }

    public function movimientosPorProducto($productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $movimientos = MovimientoInventario::where('producto_id', $productoId)
            ->with('usuario')
            ->orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('movimientos.por-producto', compact('producto', 'movimientos'));
    }

    public function movimientosPorFecha(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        $movimientos = MovimientoInventario::with(['producto', 'usuario'])
            ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
            ->orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('movimientos.por-fecha', compact('movimientos'));
    }

    public function resumenInventario()
    {
        $productos = Producto::with(['categoria', 'proveedor'])
            ->orderBy('nombre')
            ->get();

        return view('movimientos.resumen-inventario', compact('productos'));
    }

    public function productosBajoStock()
    {
        $productos = Producto::with(['categoria', 'proveedor'])
            ->whereColumn('stock_actual', '<=', 'stock_minimo')
            ->orderBy('nombre')
            ->get();

        return view('movimientos.productos-bajo-stock', compact('productos'));
    }
}