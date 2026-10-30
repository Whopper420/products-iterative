<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => fake()->words(3, true),
            'quantity' => fake()->numberBetween(0, 250),
            'description' => fake()->sentence(),
            'expiration_date' => fake()->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'status' => fake()->randomElement(['active', 'inactive', 'discontinued']),
        ];
    }
}
