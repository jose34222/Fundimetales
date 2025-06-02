<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'identificacion',
        'tipo_cliente'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id');
    }

    public function envios()
    {
        return $this->hasMany(Envio::class, 'id');
    }
}