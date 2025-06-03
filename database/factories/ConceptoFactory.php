<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConceptoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'tipo_concepto' => $this->faker->randomElement(['VENTA', 'GASTO', 'ENVIO', 'DEPOSITO']),
            'descripcion' => $this->faker->sentence,
        ];
    }
}