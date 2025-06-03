<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    use HasFactory;
    protected $table = 'cuentas_bancarias'; 


    protected $fillable = [
        'numero_cuenta',
        'banco',
        'tipo_cuenta'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cuenta_id');
    }

    public function envios()
    {
        return $this->hasMany(Envio::class, 'cuenta_id');
    }

    public function depositos()
    {
        return $this->hasMany(Deposito::class, 'cuenta_id');
    }

    public function cheques()
    {
        return $this->hasMany(Cheque::class, 'cuenta_id');
    }
}