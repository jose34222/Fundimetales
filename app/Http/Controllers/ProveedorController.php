<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'identificacion' => 'required|string|max:20|unique:proveedores',
            'telefono' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255'
        ]);

        Proveedor::create($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente');
    }

    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'identificacion' => 'required|string|max:20|unique:proveedores,identificacion,'.$id,
            'telefono' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255'
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }

    public function productos($id)
    {
        $proveedor = Proveedor::with('productos')->findOrFail($id);
        return view('proveedores.productos', compact('proveedor'));
    }  
}