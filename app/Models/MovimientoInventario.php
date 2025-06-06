<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    /** @use HasFactory<\Database\Factories\MovimientoInventarioFactory> */
    use HasFactory;

    protected $fillable = [
        'fecha',
        'producto_id',
        'tipo',
        'cantidad',
        'precio_unitario',
        'total',
        'documento',
        'numero_documento',
        'observaciones',
        'user_id'
    ];

    protected static function booted()
    {
        static::created(function ($movimiento) {
            $movimiento->producto->actualizarStock(
                $movimiento->cantidad,
                $movimiento->tipo
            );
        });
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
