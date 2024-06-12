<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    protected $model = Exam::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'course_id' => $this->faker->numberBetween(1, 50),
			'class_id' => $this->faker->numberBetween(1, 50),
			'date' => $this->faker->date(),
			'total_marks' => $this->faker->numberBetween(0, 100)
        ];
    }
}
