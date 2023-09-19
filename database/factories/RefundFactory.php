<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Refund>
 */
class RefundFactory extends Factory
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
            'order_product_id'=>fake()->numberBetween(1,2),
            'order_id'=>fake()->numberBetween(1,2),
            'amount'=>fake()->numberBetween(20,50),
            'refund_number' =>fake()->numberBetween(1,100),
            'quantity' =>fake()->numberBetween(1,2) ,
            'status' => fake()->randomElement(['pending' , 'Approved','Rejected']),
        ];
    }
}
