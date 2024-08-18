<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'active' => 1,
            'name' => 'Administrador',
            'email' => 'admin@evence.com.br',
            'password' => bcrypt('123mudar')
        ];
    }
}
