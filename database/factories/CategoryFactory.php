<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
			'description' => $this->faker->paragraph,
			'created_at' => $this->faker->dateTime,
			'updated_at' => $this->faker->dateTime
        ];
    }
}
