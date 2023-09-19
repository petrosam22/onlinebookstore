<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body'=>fake()->paragraph(2),
            'user_id'=>1,
            'book_id'=>fake()->numberBetween(1,4),
            'rate_id'=>fake()->numberBetween(1,3),
        ];
    }
}
