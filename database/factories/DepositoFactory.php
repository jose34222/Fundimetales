<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepositoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'cuenta_id' => \App\Models\CuentaBancaria::factory(),
            'valor' => $this->faker->randomFloat(2, 10000, 100000),
            'concepto_id' => \App\Models\Concepto::factory(),
            'observaciones' => $this->faker->sentence,
            'user_id' => 1,
        ];
    }
}