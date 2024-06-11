<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
			'last_name' => $this->faker->lastName(),
			'email' => $this->faker->unique()->safeEmail(),
			'phone' => $this->faker->phoneNumber(),
			'address' => $this->faker->address(),
			'position' => $this->faker->sentence(),
			'salary' => $this->faker->randomFloat(2, 0, 1000),
			'hire_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Active","Inactive","Terminated"])
        ];
    }
}
