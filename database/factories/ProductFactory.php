<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'merchant_id' => rand(1, 10),
            'price' => $this->faker->numberBetween(2000, 10000),
            'status' => $this->faker->randomElement(['normal', 'discontinued']),

        ];
    }
}
