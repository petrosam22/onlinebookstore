<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>1,
            'number'=>fake()->numberBetween(1,100),
            'payment'=>fake()->paragraph(1),
            'discounts'=>fake()->numberBetween(50,100),
            'total_products'=>fake()->numberBetween(1,7),
            'total' =>fake()->numberBetween(200,300),
        ];
    }
}
