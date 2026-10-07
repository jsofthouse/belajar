<?php

namespace Database\Factories;

use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'location' => fake()->randomElement(['MTH Square', 'SCBD', 'Zoom']),
            'held_at' => fake()->dateTimeBetween('+1 day', '+3 month'),
            'quota' => fake()->numberBetween(10, 50),
            'price' => fake()->randomElement([0, 250000, 5000000, 750000]),
        ];
    }
}
