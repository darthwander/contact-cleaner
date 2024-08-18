<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'cnpj' => $this->faker->unique()->numerify('##############'),
            'active' => $this->faker->boolean,
            'webhook_url' => $this->faker->url,
            'api_token' => env('COMPANY_API_TOKEN'),
            'delete_only_404' => $this->faker->boolean,
            'only_200' => $this->faker->boolean,
            'only_200_wp' => $this->faker->boolean,
            'code_487' => $this->faker->boolean,
            'code_487_wp' => $this->faker->boolean,
        ];
    }
}
