<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>rand(1,4),
            'book_id'=>rand(1,100),
            'rating'=>rand(1,5),
            'take_time'=>rand(1,31),
            'type'=>$this->faker->randomElement(['online','offline']),
            'comment'=>implode("\n\n", $this->faker->paragraphs(3)),
        ];
    }
}
