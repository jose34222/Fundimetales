<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use App\Models\Concepto;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;

class DepositoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestionar-depositos');
    }

    public function index()
    {
        $depositos = Deposito::with(['cuenta', 'concepto', 'usuario'])->paginate(10);
        return view('depositos.index', compact('depositos'));
    }

    public function create()
    {
        $cuentas = CuentaBancaria::all();
        $conceptos = Concepto::all();
        return view('depositos.create', compact('cuentas', 'conceptos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cuenta_id' => 'required|exists:cuentas_bancarias,cuenta_id',
            'valor' => 'required|numeric|min:0',
            'concepto_id' => 'nullable|exists:conceptos,concepto_id',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $request->merge(['user_id' => auth()->id()]);

        Deposito::create($request->all());

        return redirect()->route('depositos.index')
            ->with('success', 'Depósito registrado exitosamente.');
    }

    public function show(Deposito $deposito)
    {
        return view('depositos.show', compact('deposito'));
    }

    public function edit(Deposito $deposito)
    {
        $cuentas = CuentaBancaria::all();
        $conceptos = Concepto::all();
        return view('depositos.edit', compact('deposito', 'cuentas', 'conceptos'));
    }

    public function update(Request $request, Deposito $deposito)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cuenta_id' => 'required|exists:cuentas_bancarias,cuenta_id',
            'valor' => 'required|numeric|min:0',
            'concepto_id' => 'nullable|exists:conceptos,concepto_id',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $deposito->update($request->all());

        return redirect()->route('depositos.index')
            ->with('success', 'Depósito actualizado exitosamente.');
    }

    public function destroy(Deposito $deposito)
    {
        $deposito->delete();
        return redirect()->route('depositos.index')
            ->with('success', 'Depósito eliminado exitosamente.');
    }
}