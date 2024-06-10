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
            'user_id' => $this->faker->numberBetween(1, 50),
			'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'description' => $this->faker->paragraph(),
			'price' => $this->faker->randomFloat(2, 0, 1000),
			'stock' => $this->faker->numberBetween(0, 100),
			'category_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
