<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'email' => $this->faker->unique()->safeEmail(),
			'phone' => $this->faker->phoneNumber(),
			'address' => $this->faker->address()
        ];
    }
}
