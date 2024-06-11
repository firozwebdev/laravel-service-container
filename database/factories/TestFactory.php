<?php

namespace Database\Factories;

use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    protected $model = Test::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
			'last_name' => $this->faker->lastName(),
			'email' => $this->faker->unique()->safeEmail(),
			'phone' => $this->faker->phoneNumber(),
			'address' => $this->faker->address()
        ];
    }
}
