<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\MovimientoInventario;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'proveedor'])->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:productos',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_minimo' => 'integer|min:0',
            'unidad_medida' => 'string|max:20'
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:productos,codigo,'.$id,
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_minimo' => 'integer|min:0',
            'unidad_medida' => 'string|max:20'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function kardex($id)
    {
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id);
        $movimientos = MovimientoInventario::where('producto_id', $id)
            ->with('usuario')
            ->orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('productos.kardex', compact('producto', 'movimientos'));
    }

    public function entradaInventario(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'documento' => 'nullable|string|max:100',
            'numero_documento' => 'nullable|string|max:50',
            'observaciones' => 'nullable|string'
        ]);

        $producto = Producto::findOrFail($id);
        $user = auth()->user();

        MovimientoInventario::create([
            'fecha' => $request->fecha,
            'producto_id' => $id,
            'tipo' => 'entrada',
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'total' => $request->cantidad * $request->precio_unitario,
            'documento' => $request->documento,
            'numero_documento' => $request->numero_documento,
            'observaciones' => $request->observaciones,
            'user_id' => $user->id
        ]);

        return redirect()->route('productos.kardex', $id)->with('success', 'Entrada de inventario registrada');
    }

    public function ajusteInventario(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cantidad' => 'required|integer',
            'observaciones' => 'required|string'
        ]);

        $producto = Producto::findOrFail($id);
        $user = auth()->user();

        $diferencia = $request->cantidad - $producto->stock_actual;
        $tipo = $diferencia > 0 ? 'ajuste_entrada' : 'ajuste_salida';

        MovimientoInventario::create([
            'fecha' => $request->fecha,
            'producto_id' => $id,
            'tipo' => $tipo,
            'cantidad' => abs($diferencia),
            'precio_unitario' => $producto->precio_compra,
            'total' => abs($diferencia) * $producto->precio_compra,
            'documento' => 'AJUSTE',
            'numero_documento' => 'A-' . time(),
            'observaciones' => $request->observaciones,
            'user_id' => $user->id
        ]);

        $producto->stock_actual = $request->cantidad;
        $producto->save();

        return redirect()->route('productos.kardex', $id)->with('success', 'Ajuste de inventario realizado');
    }
}