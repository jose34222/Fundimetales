<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CuentaBancariaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'numero_cuenta' => $this->faker->unique()->bankAccountNumber,
            'banco' => $this->faker->randomElement(['Banco de Bogotá', 'Bancolombia', 'Davivienda', 'BBVA', 'Banco de Occidente']),
            'tipo_cuenta' => $this->faker->randomElement(['Ahorros', 'Corriente']),
        ];
    }
}