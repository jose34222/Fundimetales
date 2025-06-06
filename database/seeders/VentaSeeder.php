<?php

namespace Database\Seeders;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Database\Seeder;


class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

    Venta::factory(20)->create()->each(function ($venta) use ($faker) {
        $productos = Producto::inRandomOrder()
            ->limit($faker->numberBetween(1, 5))
            ->get()
            ->mapWithKeys(function ($producto) use ($faker) {
                $cantidad = $faker->numberBetween(1, 10);
                return [
                    $producto->id => [
                        'cantidad' => $cantidad,
                        'precio_unitario' => $producto->precio_venta,
                        'subtotal' => $cantidad * $producto->precio_venta
                    ]
                ];
            });

        $venta->productos()->attach($productos);

        if ($faker->boolean(50)) {
            $servicios = Servicio::inRandomOrder()
                ->limit($faker->numberBetween(1, 3))
                ->get()
                ->mapWithKeys(function ($servicio) {
                    return [
                        $servicio->id => [
                            'cantidad' => 1,
                            'precio_unitario' => $servicio->precio,
                            'subtotal' => $servicio->precio
                        ]
                    ];
                });

            $venta->servicios()->attach($servicios);
        }

        $venta->update([
            'valor' => $venta->productos->sum('pivot.subtotal') + $venta->servicios->sum('pivot.subtotal')
        ]);
    });

    }
}