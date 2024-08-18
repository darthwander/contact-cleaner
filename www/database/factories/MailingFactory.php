<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mailing>
 */
class MailingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "description" => $this->faker->sentence(),
            "config" => json_encode([
                "only_200" => $this->faker->boolean,
                "only_200_wp" => $this->faker->boolean,
                "487_cod" => $this->faker->boolean,
                "487_cod_wp" => $this->faker->boolean,
            ]),
            "filename" => "/path/to/file",
            "setup" => true,
            "error" => 0,
            "fields" => json_encode([
                'wp_200' => true,
                'wp_487' => false,
                '487_cod' => true,
                'only_200' => true,
                '487_cod_wp' => true,
                'only_200_wp' => true,
            ]),
            "export_type" => 2,
            "classification" => 1,
            "status_load" => 0,
            "status_wipe" => 0,
            "webhook" => 0,
            "webhook_send" => 0
        ];
    }
}
