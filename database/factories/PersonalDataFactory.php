<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalData>
 */
class PersonalDataFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'email' => fake()->email(),
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'patronymic' => fake()->firstName(),
            'phone' => fake()->phoneNumber(),
            'last_online' => today(),
            'email_verified_at' => now()
        ];
    }
}
