<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnvioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'referencia' => $this->faker->unique()->numerify('REF-####'),
            'lugar' => $this->faker->city,
            'valor' => $this->faker->randomFloat(2, 5000, 50000),
            'autoriza' => $this->faker->name,
            'observaciones' => $this->faker->sentence,
            'cuenta_id' => \App\Models\CuentaBancaria::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
            'user_id' => 1,
        ];
    }
}