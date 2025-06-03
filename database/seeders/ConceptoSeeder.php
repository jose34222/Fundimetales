<?php

namespace Database\Seeders;

use App\Models\Concepto;
use Illuminate\Database\Seeder;

class ConceptoSeeder extends Seeder
{
    public function run(): void
    {
        // Conceptos para ventas
        Concepto::create(['nombre' => 'Venta de producto A', 'tipo_concepto' => 'VENTA']);
        Concepto::create(['nombre' => 'Venta de producto B', 'tipo_concepto' => 'VENTA']);
        Concepto::create(['nombre' => 'Venta de servicio', 'tipo_concepto' => 'VENTA']);
        
        // Conceptos para gastos
        Concepto::create(['nombre' => 'Materiales de oficina', 'tipo_concepto' => 'GASTO']);
        Concepto::create(['nombre' => 'Servicios públicos', 'tipo_concepto' => 'GASTO']);
        Concepto::create(['nombre' => 'Nómina', 'tipo_concepto' => 'GASTO']);
        
        // Conceptos para envíos
        Concepto::create(['nombre' => 'Envío nacional', 'tipo_concepto' => 'ENVIO']);
        Concepto::create(['nombre' => 'Envío internacional', 'tipo_concepto' => 'ENVIO']);
        
        // Conceptos para depósitos
        Concepto::create(['nombre' => 'Depósito por venta', 'tipo_concepto' => 'DEPOSITO']);
        Concepto::create(['nombre' => 'Depósito por transferencia', 'tipo_concepto' => 'DEPOSITO']);
    }
}