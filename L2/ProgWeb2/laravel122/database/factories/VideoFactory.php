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
        'image' => 'https://picsum.photos/seed/' . fake()->unique()->numberBetween(1, 100) . '/1200/1600',
        'year' => fake()->year(),
        'price' => fake()->numberBetween(10, 100),
        'is_published' => fake()->boolean(80), 
    ];
    }
}
