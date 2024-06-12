<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 50),
			'course_id' => $this->faker->numberBetween(1, 50),
			'enrollment_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Active","Completed","Withdrawn"])
        ];
    }
}
