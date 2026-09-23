<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear o asegurar los roles de Spatie / Shield
        $superAdminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $clienteRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'cliente', 'guard_name' => 'web']);

        // 2. Usuario Super Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@ecoentrega.com'],
            [
                'name' => 'Administrador EcoEntrega',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]
        );
        if (! $admin->hasRole('super_admin')) {
            $admin->assignRole($superAdminRole);
        }

        // 3. Usuario Cliente de prueba
        $user = User::firstOrCreate(
            ['email' => 'user@ecoentrega.com'],
            [
                'name' => 'Usuario Cliente',
                'password' => bcrypt('password123'),
                'role' => 'cliente',
            ]
        );
        if (! $user->hasRole('cliente')) {
            $user->assignRole($clienteRole);
        }

        // 4. Crear registro en la tabla clients para el usuario cliente
        \App\Models\Client::firstOrCreate(
            ['id_user' => $user->id],
            [
                'phone' => '3001234567',
                'address' => 'Calle Principal # 123',
            ]
        );

        // 5. Asignar rol 'cliente' a cualquier usuario en la base de datos que aún no tenga rol de Shield
        $usersWithoutRole = User::whereDoesntHave('roles')->get();
        foreach ($usersWithoutRole as $orphanUser) {
            $orphanUser->assignRole($clienteRole);
            if ($orphanUser->role === 'user') {
                $orphanUser->update(['role' => 'cliente']);
            }
        }
    }
}
