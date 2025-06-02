<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Cliente;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    public function __construct()
    {
       
    }

    public function index()
    {
        $envios = Envio::with(['cliente', 'cuenta', 'usuario'])->paginate(10);
        return view('envios.index', compact('envios'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $cuentas = CuentaBancaria::all();
        return view('envios.create', compact('clientes', 'cuentas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'referencia' => 'required|string|max:100',
            'lugar' => 'required|string|max:100',
            'valor' => 'nullable|numeric|min:0',
            'autoriza' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string|max:255',
            'cuenta_id' => 'nullable|exists:cuentas_bancarias,cuenta_id',
            'cliente_id' => 'nullable|exists:clientes,cliente_id',
        ]);

        $request->merge(['user_id' => auth()->id()]);

        Envio::create($request->all());

        return redirect()->route('envios.index')
            ->with('success', 'Envío registrado exitosamente.');
    }

    public function show(Envio $envio)
    {
        return view('envios.show', compact('envio'));
    }

    public function edit(Envio $envio)
    {
        $clientes = Cliente::all();
        $cuentas = CuentaBancaria::all();
        return view('envios.edit', compact('envio', 'clientes', 'cuentas'));
    }

    public function update(Request $request, Envio $envio)
    {
        $request->validate([
            'fecha' => 'required|date',
            'referencia' => 'required|string|max:100',
            'lugar' => 'required|string|max:100',
            'valor' => 'nullable|numeric|min:0',
            'autoriza' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string|max:255',
            'cuenta_id' => 'nullable|exists:cuentas_bancarias,cuenta_id',
            'cliente_id' => 'nullable|exists:clientes,cliente_id',
        ]);

        $envio->update($request->all());

        return redirect()->route('envios.index')
            ->with('success', 'Envío actualizado exitosamente.');
    }

    public function destroy(Envio $envio)
    {
        $envio->delete();
        return redirect()->route('envios.index')
            ->with('success', 'Envío eliminado exitosamente.');
    }
}