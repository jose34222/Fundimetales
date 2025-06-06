<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Concepto;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('can:gestionar-ventas');
    }

    public function index()
    {
        $ventas = Venta::with(['cliente', 'concepto', 'cuenta', 'usuario'])
            ->orderBy('fecha', 'desc')
            ->paginate(10);
            
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $conceptos = Concepto::where('tipo_concepto', 'VENTA')->get();
        $cuentas = CuentaBancaria::all();
        $productos = Producto::where('activo', true)->get();
        $servicios = Servicio::where('activo', true)->get();
        
        return view('ventas.create', compact(
            'clientes', 
            'conceptos', 
            'cuentas',
            'productos',
            'servicios'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cliente_id' => 'required|exists:clientes,id',
            'concepto_id' => 'required|exists:conceptos,id',
            'cuenta_id' => 'nullable|exists:cuentas_bancarias,id',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            'productos' => 'nullable|array',
            'productos.*.id' => 'required_with:productos|exists:productos,id',
            'productos.*.cantidad' => 'required_with:productos|integer|min:1',
            'productos.*.precio' => 'required_with:productos|numeric|min:0',
            'servicios' => 'nullable|array',
            'servicios.*.id' => 'required_with:servicios|exists:servicios,id',
            'servicios.*.cantidad' => 'required_with:servicios|integer|min:1',
            'servicios.*.precio' => 'required_with:servicios|numeric|min:0',
        ]);

        // Crear la venta
        $venta = Venta::create([
            'fecha' => $request->fecha,
            'cliente_id' => $request->cliente_id,
            'concepto_id' => $request->concepto_id,
            'cuenta_id' => $request->cuenta_id,
            'valor' => $request->valor,
            'observaciones' => $request->observaciones,
            'user_id' => auth()->id()
        ]);

        // Procesar productos vendidos
        if ($request->has('productos')) {
            foreach ($request->productos as $productoVenta) {
                $producto = Producto::find($productoVenta['id']);

                // Agregar producto a la venta
                $venta->productos()->attach($productoVenta['id'], [
                    'cantidad' => $productoVenta['cantidad'],
                    'precio_unitario' => $productoVenta['precio'],
                    'subtotal' => $productoVenta['cantidad'] * $productoVenta['precio']
                ]);

                // Registrar movimiento de salida en el kardex
                MovimientoInventario::create([
                    'fecha' => $venta->fecha,
                    'producto_id' => $productoVenta['id'],
                    'tipo' => 'salida',
                    'cantidad' => $productoVenta['cantidad'],
                    'precio_unitario' => $productoVenta['precio'],
                    'total' => $productoVenta['cantidad'] * $productoVenta['precio'],
                    'documento' => 'VENTA',
                    'numero_documento' => $venta->id,
                    'observaciones' => 'Venta a cliente: ' . $venta->cliente->nombre,
                    'user_id' => auth()->id()
                ]);
            }
        }

        // Procesar servicios vendidos
        if ($request->has('servicios')) {
            foreach ($request->servicios as $servicioVenta) {
                $venta->servicios()->attach($servicioVenta['id'], [
                    'cantidad' => $servicioVenta['cantidad'],
                    'precio_unitario' => $servicioVenta['precio'],
                    'subtotal' => $servicioVenta['cantidad'] * $servicioVenta['precio']
                ]);
            }
        }

        return redirect()->route('ventas.show', $venta->id)
            ->with('success', 'Venta registrada exitosamente.');
    }

    public function show(Venta $venta)
    {
        $venta->load([
            'cliente', 
            'concepto', 
            'cuenta', 
            'usuario',
            'productos',
            'servicios'
        ]);
        
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        $clientes = Cliente::all();
        $conceptos = Concepto::where('tipo_concepto', 'VENTA')->get();
        $cuentas = CuentaBancaria::all();
        $productos = Producto::where('activo', true)->get();
        $servicios = Servicio::where('activo', true)->get();
        
        // Cargar productos y servicios asociados a la venta
        $venta->load(['productos', 'servicios']);
        
        return view('ventas.edit', compact(
            'venta',
            'clientes', 
            'conceptos', 
            'cuentas',
            'productos',
            'servicios'
        ));
    }

    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cliente_id' => 'required|exists:clientes,id',
            'concepto_id' => 'required|exists:conceptos,id',
            'cuenta_id' => 'nullable|exists:cuentas_bancarias,id',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            'productos' => 'nullable|array',
            'productos.*.id' => 'required_with:productos|exists:productos,id',
            'productos.*.cantidad' => 'required_with:productos|integer|min:1',
            'productos.*.precio' => 'required_with:productos|numeric|min:0',
            'servicios' => 'nullable|array',
            'servicios.*.id' => 'required_with:servicios|exists:servicios,id',
            'servicios.*.cantidad' => 'required_with:servicios|integer|min:1',
            'servicios.*.precio' => 'required_with:servicios|numeric|min:0',
        ]);

        // Actualizar datos básicos de la venta
        $venta->update([
            'fecha' => $request->fecha,
            'cliente_id' => $request->cliente_id,
            'concepto_id' => $request->concepto_id,
            'cuenta_id' => $request->cuenta_id,
            'valor' => $request->valor,
            'observaciones' => $request->observaciones
        ]);

        // Sincronizar productos
        if ($request->has('productos')) {
            $productosData = [];
            foreach ($request->productos as $producto) {
                $productosData[$producto['id']] = [
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'subtotal' => $producto['cantidad'] * $producto['precio']
                ];
            }
            $venta->productos()->sync($productosData);
            
            // Actualizar movimientos de inventario (esto es simplificado, en producción necesitarías más lógica)
            MovimientoInventario::where('documento', 'VENTA')
                ->where('numero_documento', $venta->id)
                ->delete();
                
            foreach ($request->productos as $productoVenta) {
                MovimientoInventario::create([
                    'fecha' => $venta->fecha,
                    'producto_id' => $productoVenta['id'],
                    'tipo' => 'salida',
                    'cantidad' => $productoVenta['cantidad'],
                    'precio_unitario' => $productoVenta['precio'],
                    'total' => $productoVenta['cantidad'] * $productoVenta['precio'],
                    'documento' => 'VENTA',
                    'numero_documento' => $venta->id,
                    'observaciones' => 'Venta a cliente: ' . $venta->cliente->nombre,
                    'user_id' => auth()->id()
                ]);
            }
        } else {
            $venta->productos()->detach();
            MovimientoInventario::where('documento', 'VENTA')
                ->where('numero_documento', $venta->id)
                ->delete();
        }

        // Sincronizar servicios
        if ($request->has('servicios')) {
            $serviciosData = [];
            foreach ($request->servicios as $servicio) {
                $serviciosData[$servicio['id']] = [
                    'cantidad' => $servicio['cantidad'],
                    'precio_unitario' => $servicio['precio'],
                    'subtotal' => $servicio['cantidad'] * $servicio['precio']
                ];
            }
            $venta->servicios()->sync($serviciosData);
        } else {
            $venta->servicios()->detach();
        }

        return redirect()->route('ventas.show', $venta->id)
            ->with('success', 'Venta actualizada exitosamente.');
    }

    public function destroy(Venta $venta)
    {
        // Eliminar movimientos de inventario asociados
        MovimientoInventario::where('documento', 'VENTA')
            ->where('numero_documento', $venta->id)
            ->delete();
            
        // Eliminar relaciones con productos y servicios
        $venta->productos()->detach();
        $venta->servicios()->detach();
        
        // Eliminar la venta
        $venta->delete();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada exitosamente.');
    }

    public function kardex(Producto $producto)
    {
        $movimientos = MovimientoInventario::where('producto_id', $producto->id)
            ->with(['usuario'])
            ->orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('ventas.kardex', compact('producto', 'movimientos'));
    }
}