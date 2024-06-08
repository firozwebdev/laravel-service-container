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
            'title' => $this->faker->word,
			'price' => $this->faker->word,
			'description' => $this->faker->paragraph,
			'created_at' => $this->faker->dateTime,
			'updated_at' => $this->faker->dateTime
        ];
    }
}
