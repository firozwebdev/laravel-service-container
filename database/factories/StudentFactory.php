<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

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
			'enrollment_date' => $this->faker->date(),
			'department_id' => $this->faker->numberBetween(1, 50),
			'program_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
