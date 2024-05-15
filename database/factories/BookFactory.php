<?php

namespace Database\Factories;

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
        return [
            'user_id' => rand(1, 4),
            'genre_id' => rand(1, 50),
            'title' => $this->faker->sentences(3, true),
            'image' => 'laravel.png',
            'description' => $this->faker->paragraphs(3, true),
            'page_number' => rand(100, 900),
        ];
    }
}
