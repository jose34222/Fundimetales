<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GastoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'concepto_id' => \App\Models\Concepto::factory(),
            'valor' => $this->faker->randomFloat(2, 1000, 50000),
            'detalles' => $this->faker->sentence,
            'user_id' => 1,
        ];
    }
}