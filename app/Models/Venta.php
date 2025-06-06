<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'fecha',
        'cliente_id',
        'concepto_id',
        'cuenta_id',
        'valor',
        'observaciones',
        'user_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class, 'concepto_id');
    }

    public function cuenta()
    {
        return $this->belongsTo(CuentaBancaria::class, 'cuenta_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Nueva relación con productos (para venta de productos)
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'venta_productos')
            ->withPivot('cantidad', 'precio_unitario', 'subtotal')
            ->withTimestamps();
    }

    // Nueva relación con servicios (para venta de servicios)
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'venta_servicios')
            ->withPivot('cantidad', 'precio_unitario', 'subtotal')
            ->withTimestamps();
    }
}