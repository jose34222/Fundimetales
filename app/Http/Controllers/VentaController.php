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
        $ventas = Venta::with(['cliente', 'concepto', 'cuenta', 'usuario'])->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $conceptos = Concepto::where('tipo_concepto', 'VENTA')->get();
        $cuentas = CuentaBancaria::all();
        return view('ventas.create', compact('clientes', 'conceptos', 'cuentas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cliente_id' => 'required',
            'concepto_id' => 'required',
            'cuenta_id' => 'nullable',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $request->merge(['user_id' => auth()->id()]);

        Venta::create($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta registrada exitosamente.');
    }

    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        $clientes = Cliente::all();
        $conceptos = Concepto::where('tipo_concepto', 'VENTA')->get();
        $cuentas = CuentaBancaria::all();
        return view('ventas.edit', compact('venta', 'clientes', 'conceptos', 'cuentas'));
    }

    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cliente_id' => 'required|exists:clientes,cliente_id',
            'concepto_id' => 'required|exists:conceptos,concepto_id',
            'cuenta_id' => 'nullable|exists:cuentas_bancarias,cuenta_id',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $venta->update($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta actualizada exitosamente.');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada exitosamente.');
    }
}