<?php

namespace Database\Factories;

use App\Models\Result;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    protected $model = Result::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 50),
			'exam_id' => $this->faker->numberBetween(1, 50),
			'marks_obtained' => $this->faker->numberBetween(0, 100),
			'grade' => $this->faker->sentence()
        ];
    }
}
