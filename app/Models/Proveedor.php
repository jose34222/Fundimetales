<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /** @use HasFactory<\Database\Factories\ProveedorFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'identificacion',
        'telefono',
        'email',
        'direccion'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
