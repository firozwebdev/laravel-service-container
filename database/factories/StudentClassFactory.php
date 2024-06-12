<?php

namespace Database\Factories;

use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentClassFactory extends Factory
{
    protected $model = StudentClass::class;

    public function definition()
    {
        return [
            'course_id' => $this->faker->numberBetween(1, 50),
			'faculty_id' => $this->faker->numberBetween(1, 50),
			'semester' => $this->faker->sentence(),
			'year' => $this->faker->numberBetween(0, 100)
        ];
    }
}
