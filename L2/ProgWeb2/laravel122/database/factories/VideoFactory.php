<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'title' => fake()->sentence(3),
        'description' => fake()->paragraph(),
        'image' => fake()->imageUrl(),
        'year' => fake()->year(),
        'price' => fake()->numberBetween(10, 100),
        'is_published' => fake()->boolean(80), 
    ];
    }
}
