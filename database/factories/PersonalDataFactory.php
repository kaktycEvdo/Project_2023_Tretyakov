<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalData>
 */
class PersonalDataFactory extends Factory
{
    protected static ?string $password;
    public function definition(): array
    {
        return [
            'login' => fake()->userName(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
