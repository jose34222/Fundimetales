<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Concepto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class GastoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('can:gestionar-gastos');
    }

    public function index()
    {
        $gastos = Gasto::with(['concepto', 'usuario'])->paginate(10);
        return view('gastos.index', compact('gastos'));
    }

    public function create()
    {
        $conceptos = Concepto::where('tipo_concepto', 'GASTO')->get();
        return view('gastos.create', compact('conceptos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'concepto_id' => 'required',
            'valor' => 'required|numeric|min:0',
            'detalles' => 'nullable|string|max:255',
        ]);

        $request->merge(['user_id' => auth()->id()]);

        Gasto::create($request->all());

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto registrado exitosamente.');
    }

    public function show(Gasto $gasto)
    {
        return view('gastos.show', compact('gasto'));
    }

    public function edit(Gasto $gasto)
    {
        $conceptos = Concepto::where('tipo_concepto', 'GASTO')->get();
        return view('gastos.edit', compact('conceptos'));
    }

    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'fecha' => 'required|date',
            'concepto_id' => 'required|exists:conceptos,concepto_id',
            'valor' => 'required|numeric|min:0',
            'detalles' => 'nullable|string|max:255',
        ]);

        $gasto->update($request->all());

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto actualizado exitosamente.');
    }

    public function destroy(Gasto $gasto)
    {
        $gasto->delete();
        return redirect()->route('gastos.index')
            ->with('success', 'Gasto eliminado exitosamente.');
    }
}