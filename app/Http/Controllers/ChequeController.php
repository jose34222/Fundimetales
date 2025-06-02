<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;

class ChequeController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
        //$this->middleware('can:gestionar-cheques');
    }

    public function index()
    {
        $cheques = Cheque::paginate(10);
        return view('cheques.index', compact('cheques'));
    }

    public function create()
    {
        $cuentas = CuentaBancaria::all();
        return view('cheques.create', compact('cuentas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'numero_cheque' => 'required|string|max:20',
            'banco' => 'required|string|max:50',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            'cuenta_id' => 'nullable|exists:cuentas_bancarias,cuenta_id',
        ]);

        $request->merge(['user_id' => auth()->id()]);

        Cheque::create($request->all());

        return redirect()->route('cheques.index')
            ->with('success', 'Cheque registrado exitosamente.');
    }

    public function show(Cheque $cheque)
    {
        return view('cheques.show', compact('cheque'));
    }

    public function edit(Cheque $cheque)
    {
        $cuentas = CuentaBancaria::all();
        return view('cheques.edit', compact('cheque', 'cuentas'));
    }

    public function update(Request $request, Cheque $cheque)
    {
        $request->validate([
            'fecha' => 'required|date',
            'numero_cheque' => 'required|string|max:20',
            'banco' => 'required|string|max:50',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            'cuenta_id' => 'nullable|exists:cuentas_bancarias,cuenta_id',
        ]);

        $cheque->update($request->all());

        return redirect()->route('cheques.index')
            ->with('success', 'Cheque actualizado exitosamente.');
    }

    public function destroy(Cheque $cheque)
    {
        $cheque->delete();
        return redirect()->route('cheques.index')
            ->with('success', 'Cheque eliminado exitosamente.');
    }
}