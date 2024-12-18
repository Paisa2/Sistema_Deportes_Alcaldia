<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'estadoCuenta' => 'Habilitado',
            'password' => 'admin',
            'ci' => '1234567',

        ]);

        $user->assignRole('Admin');

        $user2 = User::create([
            'name' => 'Jaime Rodriguez',
            'email' => 'entrenador@gmail.com',
            'estadoCuenta' => 'Habilitado',
            'password' => 'entrenador',
            'ci' => '5432101',

        ]);

        $user2->assignRole('User');

        $user3 = User::create([
            'name' => 'Paco Fernandez',
            'email' => 'entrenador2@gmail.com',
            'estadoCuenta' => 'Habilitado',
            'password' => 'entrenador2',
            'ci' => '4232332',

        ]);

        $user3->assignRole('User');
    }
}
