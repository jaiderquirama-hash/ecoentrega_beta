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
        // Usuario Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@ecoentrega.com'],
            [
                'name' => 'Administrador EcoEntrega',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]
        );

        // Usuario Cliente de prueba
        $user = User::firstOrCreate(
            ['email' => 'user@ecoentrega.com'],
            [
                'name' => 'Usuario Cliente',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ]
        );

        // Crear registro en la tabla clients para el usuario cliente
        \App\Models\Client::firstOrCreate(
            ['id_user' => $user->id],
            [
                'phone' => '3001234567',
                'address' => 'Calle Principal # 123',
            ]
        );
    }
}
