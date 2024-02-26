<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->country,
            'description' => fake()->paragraph,
            'price' => random_int(100,10000),
            'qnt' => random_int(0,25),
            'user_id' => random_int(1,4)
        ];

    }
}
