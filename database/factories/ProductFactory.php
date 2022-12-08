<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'type' => fake()->name(),
            'category' => fake()->name(),
            'price' => fake()->randomFloat,
            'description' => fake()->name(),
            'image' => fake()->image('storage\app\public\images\products',400,300)
        ];
    }
}
