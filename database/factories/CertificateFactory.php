<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'associated_company' => fake()->company(),
            'about' => fake()->realText(700)
        ];
    }
}
