<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mr Grafista',
            'email' => 'mrgrafista@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1002493883',
            'address' => 'sincelejo',
            'phone' => '3233332112',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Paciente',
            'email' => 'paciente1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1002493883',
            'role' => 'paciente',
        ]);

        User::create([
            'name' => 'Medico',
            'email' => 'medico1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'role' => 'doctor',
        ]);

        User::create([
            'name' => 'Asesor',
            'email' => 'asesor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'role' => 'asesor',
        ]);

        User::factory()
            ->count(50)
            ->state(['role' => 'paciente'])
            ->create();
    }
}
