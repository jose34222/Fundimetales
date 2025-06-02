<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;   

class ConceptoController extends Controller
{
    public function __construct()
    {
        
       
    }

    public function index()
    {
        $conceptos = Concepto::paginate(10);
        return view('conceptos.index', compact('conceptos'));
    }

    public function create()
    {
        return view('conceptos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_concepto' => 'required|string|max:30',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Concepto::create($request->all());

        return redirect()->route('conceptos.index')
            ->with('success', 'Concepto creado exitosamente.');
    }

    public function show(Concepto $concepto)
    {
        return view('conceptos.show', compact('concepto'));
    }

    public function edit(Concepto $concepto)
    {
        return view('conceptos.edit', compact('concepto'));
    }

    public function update(Request $request, Concepto $concepto)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_concepto' => 'required|string|max:30',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $concepto->update($request->all());

        return redirect()->route('conceptos.index')
            ->with('success', 'Concepto actualizado exitosamente.');
    }

    public function destroy(Concepto $concepto)
    {
        $concepto->delete();
        return redirect()->route('conceptos.index')
            ->with('success', 'Concepto eliminado exitosamente.');
    }
}