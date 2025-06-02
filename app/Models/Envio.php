<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'fecha',
        'referencia',
        'lugar',
        'valor',
        'autoriza',
        'observaciones',
        'cuenta_id',
        'cliente_id',
        'user_id'
    ];

    public function cuenta()
    {
        return $this->belongsTo(CuentaBancaria::class, 'cuenta_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}