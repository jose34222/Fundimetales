<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            // Módulo Ventas
            'ver-ventas',
            'crear-ventas',
            'editar-ventas',
            'eliminar-ventas',
            
            // Módulo Gastos
            'ver-gastos',
            'crear-gastos',
            'editar-gastos',
            'eliminar-gastos',
            
            // Módulo Envíos
            'ver-envios',
            'crear-envios',
            'editar-envios',
            'eliminar-envios',
            
            // Módulo Administración
            'gestionar-usuarios',
            'gestionar-roles',
            'ver-reportes',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        $empleado = Role::firstOrCreate(['name' => 'Empleado']);
        $empleado->givePermissionTo([
            'ver-ventas',
            'crear-ventas',
            'editar-ventas',
            'ver-gastos',
            'crear-gastos',
            'ver-envios',
            'crear-envios',
        ]);

        // Crear usuario admin
        $userAdmin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);
        $userAdmin->assignRole('Administrador');

        // Crear usuario empleado
        $userEmpleado = User::create([
            'name' => 'Empleado Ejemplo',
            'email' => 'empleado@example.com',
            'password' => bcrypt('password123'),
        ]);
        $userEmpleado->assignRole('Empleado');
    }
}