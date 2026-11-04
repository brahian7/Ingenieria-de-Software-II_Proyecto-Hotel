<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed de usuarios base del sistema.
     */
    public function run(): void
    {
        // ==========================
        // Administrador
        // ==========================

        User::updateOrCreate(

            [
                'email' => 'administradorlaravel@gmail.com',
            ],

            [
                'nombre' => 'Administrador',
                'apellido' => 'Sistema',
                'password' => Hash::make('seminariolaravel'),
                'rol' => 'Administrador',
                'estado' => true,
            ]

        );

        // ==========================
        // Recepcionista
        // ==========================

        User::updateOrCreate(

            [
                'email' => 'recepcionistalaravel@gmail.com',
            ],

            [
                'nombre' => 'Recepcionista',
                'apellido' => 'Hotel',
                'password' => Hash::make('seminariolaravel'),
                'rol' => 'Recepcionista',
                'estado' => true,
            ]

        );

        // ==========================
        // Cliente
        // ==========================

        User::updateOrCreate(

            [
                'email' => 'clientelaravel@gmail.com',
            ],

            [
                'nombre' => 'Cliente',
                'apellido' => 'Prueba',
                'password' => Hash::make('seminariolaravel'),
                'rol' => 'Cliente',
                'estado' => true,
            ]

        );
    }
}