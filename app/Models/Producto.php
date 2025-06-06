<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'categoria_id',
        'proveedor_id',
        'precio_compra',
        'precio_venta',
        'stock_minimo',
        'stock_actual',
        'unidad_medida',
        'activo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoInventario::class);
    }

    // Método para actualizar stock
    public function actualizarStock($cantidad, $tipo)
    {
        if ($tipo === 'entrada') {
            $this->stock_actual += $cantidad;
        } elseif ($tipo === 'salida') {
            $this->stock_actual -= $cantidad;
        }
        $this->save();
    }

}
