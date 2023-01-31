<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'apellido' => $this->faker->apellido(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'tdocumento' => $this->faker->tdocumento(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'cedula' => $this->faker->unique(6, true),
            'fnacimiento' => $this->faker->fnacimiento(),
            'dpto' => $this->faker->dpto(),
            'municipio' => $this->faker->municipio(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->tollFreePhoneNumber(),
            'phone2' => $this->faker->tollFreePhoneNumber(),
            'role' => $this->faker->randomElement(['paciente','doctor', 'admin']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'cedula_verified_at' => null,
            ];
        });
    }
}
