<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'identificacion' => $this->faker->unique()->numerify('###########'),
            'tipo_cliente' => $this->faker->randomElement(['Persona Natural', 'Persona Jurídica']),
        ];
    }
}