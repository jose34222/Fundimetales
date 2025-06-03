<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario admin
        User::create([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'tipo_usuario' => 'admin',
        ]);

        // Crear usuario regular
        User::create([
            'username' => 'user',
            'firstname' => 'Regular',
            'lastname' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'tipo_usuario' => 'empleado',
        ]);

        // Crear usuarios de prueba
        User::factory()->count(8)->create();
    }
}