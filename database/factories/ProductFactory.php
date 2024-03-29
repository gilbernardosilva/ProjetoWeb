<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use App\Models\Product;
use App\Models\Platform;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'key' => fake() -> text(20),
            'game_id' => Game::all()->random()->id,
            'user_id' =>  Arr::random(array(1,2,3)),
            'platform_id' => Platform::all()->random()->id,
            'price' => fake() -> randomFloat(2,0,100),
            'discount' => fake() -> randomFloat(0,0,100),
        ];
    }
}
