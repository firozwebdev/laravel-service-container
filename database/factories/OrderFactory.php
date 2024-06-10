<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
			'price' => $this->faker->randomFloat(2, 0, 1000),
			'description' => $this->faker->paragraph()
        ];
    }
}
