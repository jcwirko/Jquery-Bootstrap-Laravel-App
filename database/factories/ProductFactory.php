<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'description' => $this->faker->text(30),
            'unit_price' => $this->faker->randomFloat(2, 1, 200),
            'quantity' => $this->faker->randomDigit,
            'total_cost' => $this->faker->randomFloat(2, 1, 200)
        ];
    }
}
