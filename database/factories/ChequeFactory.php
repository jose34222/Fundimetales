<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChequeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'numero_cheque' => $this->faker->unique()->numerify('#######'),
            'banco' => $this->faker->randomElement(['Banco de Bogotá', 'Bancolombia', 'Davivienda', 'BBVA', 'Banco de Occidente']),
            'valor' => $this->faker->randomFloat(2, 10000, 500000),
            'observaciones' => $this->faker->sentence,
            'cuenta_id' => \App\Models\CuentaBancaria::factory(),
            'user_id' => 1,
        ];
    }
}