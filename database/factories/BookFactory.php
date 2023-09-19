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
            'name'=>fake()->name(),
            'author_id'=>1,
            'user_id'=>1,
            'publisher_id'=>1,
            'image'=>fake()->image(),
            'description'=>fake()->paragraph(5),
            'quantity'=>fake()->numberBetween(1,5),
            'category_id'=>fake()->numberBetween(1,5),
            'price'=>fake()->numberBetween(100,200),
        ];
    }
}
