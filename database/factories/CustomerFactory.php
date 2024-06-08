<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->sentence(),
			'last_name' => $this->faker->sentence(),
			'email' => $this->faker->sentence(),
			'phone' => $this->faker->sentence(),
			'address' => $this->faker->paragraph(),
			'created_at' => $this->faker->dateTime(),
			'updated_at' => $this->faker->dateTime()
        ];
    }
}
