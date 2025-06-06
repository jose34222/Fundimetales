<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->bothify('PROD-####'),
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'categoria_id' => \App\Models\Categoria::factory(),
            'proveedor_id' => \App\Models\Proveedor::factory(),
            'precio_compra' => $this->faker->randomFloat(2, 1000, 10000),
            'precio_venta' => $this->faker->randomFloat(2, 1500, 15000),
            'stock_minimo' => $this->faker->numberBetween(5, 20),
            'stock_actual' => $this->faker->numberBetween(0, 100),
            'unidad_medida' => $this->faker->randomElement(['unidad', 'kg', 'litro', 'metro']),
            'activo' => true,
        ];
    }
}
