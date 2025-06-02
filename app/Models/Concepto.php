<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_concepto',
        'descripcion'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'concepto_id');
    }

    public function gastos()
    {
        return $this->hasMany(Gasto::class, 'concepto_id');
    }

    public function depositos()
    {
        return $this->hasMany(Deposito::class, 'concepto_id');
    }
}