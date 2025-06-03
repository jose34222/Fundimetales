<?php

namespace Database\Seeders;

use App\Models\CuentaBancaria;
use Illuminate\Database\Seeder;

class CuentaBancariaSeeder extends Seeder
{
    public function run(): void
    {
        CuentaBancaria::factory()->count(5)->create();
    }
}