<?php

namespace Database\Factories;
use App\Models\Author;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
          public function definition(): array
    {
        $id = Author::first()->id;
        return [
            'title' => fake()->sentence($nbWords = 3, $variableNbWords = true),
            'description' => fake()->text($maxNbChars = 200),
            'image' => 'book.webp',
            'page' => rand(50, 300),
            'price' => rand(30, 100),
            'is_published' => rand(0, 1),
            'author_id' => $id,
        ];
    }
}
