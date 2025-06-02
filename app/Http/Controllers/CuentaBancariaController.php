<?php

namespace App\Http\Controllers;

use App\Models\CuentaBancaria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CuentaBancariaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('can:gestionar-cuentas');
        
    }

    public function index()
    {
        $cuentas = CuentaBancaria::paginate(10);
        return view('cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        return view('cuentas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_cuenta' => 'required|string|max:20|unique:cuentas_bancarias',
            'banco' => 'required|string|max:50',
            'tipo_cuenta' => 'required|string|max:30',
        ]);

        CuentaBancaria::create($request->all());

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta bancaria creada exitosamente.');
    }

    public function show(CuentaBancaria $cuenta)
    {
        return view('cuentas.show', compact('cuenta'));
    }

    public function edit(CuentaBancaria $cuenta)
    {
        return view('cuentas.edit', compact('cuenta'));
    }

    public function update(Request $request, CuentaBancaria $cuenta)
    {
        $request->validate([
            'numero_cuenta' => [
                'required',
                'string',
                'max:20',
                Rule::unique('cuentas_bancarias')->ignore($cuenta->cuenta_id, 'cuenta_id'),
            ],
            'banco' => 'required|string|max:50',
            'tipo_cuenta' => 'required|string|max:30',
        ]);

        $cuenta->update($request->all());

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta bancaria actualizada exitosamente.');
    }

    public function destroy(CuentaBancaria $cuenta)
    {
        $cuenta->delete();
        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta bancaria eliminada exitosamente.');
    }
}