<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    protected $model = Faculty::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
			'first_name' => $this->faker->firstName(),
			'last_name' => $this->faker->lastName(),
			'dob' => $this->faker->date(),
			'gender' => $this->faker->randomElement(["Male","Female","Other"]),
			'address' => $this->faker->address(),
			'city' => $this->faker->city(),
			'state' => $this->faker->sentence(),
			'zip_code' => $this->faker->sentence(),
			'hire_date' => $this->faker->date(),
			'department_id' => $this->faker->numberBetween(1, 50),
			'designation' => $this->faker->sentence()
        ];
    }
}
