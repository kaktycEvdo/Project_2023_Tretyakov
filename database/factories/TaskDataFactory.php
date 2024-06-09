<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskData>
 */
class TaskDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reward' => fake()->randomNumber(6),
            'text' => fake()->realText(2000),
            'payment_method' => fake()->numberBetween(0, 2),
            'deadline' => fake()->dateTimeBetween('+3 days', '+4 weeks')
        ];
    }
}
