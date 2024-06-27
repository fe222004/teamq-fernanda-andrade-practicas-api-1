<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'fernanda@gmail.com'], // Verifica por el correo electrónico único
            [
                'name' => 'Fernanda',
                'password' => bcrypt('password'), // Ajusta la contraseña según tus requerimientos
            ]
        );

        // Crear otros usuarios aleatorios
        User::factory(4)->create(); // Cambibia el número según cuántos usuarios adicionales deseas crear
    }
}
