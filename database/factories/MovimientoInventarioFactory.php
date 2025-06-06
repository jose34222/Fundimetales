<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovimientoInventario>
 */
class MovimientoInventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = $this->faker->randomElement(['entrada', 'salida', 'ajuste_entrada', 'ajuste_salida']);
        $producto = \App\Models\Producto::factory()->create();
        
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'producto_id' => $producto->id,
            'tipo' => $tipo,
            'cantidad' => $this->faker->numberBetween(1, 50),
            'precio_unitario' => $producto->precio_compra,
            'total' => function (array $attributes) use ($producto) {
                return $attributes['cantidad'] * $producto->precio_compra;
            },
            'documento' => $this->faker->randomElement(['FACTURA', 'REMISION', 'AJUSTE', 'COMPRA']),
            'numero_documento' => $this->faker->unique()->numerify('DOC-####'),
            'observaciones' => $this->faker->sentence,
            'user_id' => 1,
        ];
    }
}
