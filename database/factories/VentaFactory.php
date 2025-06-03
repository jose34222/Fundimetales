<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VentaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'cliente_id' => \App\Models\Cliente::factory(),
            'concepto_id' => \App\Models\Concepto::factory(),
            'cuenta_id' => \App\Models\CuentaBancaria::factory(),
            'valor' => $this->faker->randomFloat(2, 1000, 100000),
            'observaciones' => $this->faker->sentence,
            'user_id' => 1,
        ];
    }
}