<?php

namespace Database\Factories;

use App\Models\ExamSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamSubmissionFactory extends Factory
{
    protected $model = ExamSubmission::class;

    public function definition()
    {
        return [
            'exam_id' => $this->faker->numberBetween(1, 50),
			'student_id' => $this->faker->numberBetween(1, 50),
			'submitted_at' => $this->faker->dateTime(),
			'total_marks' => $this->faker->numberBetween(0, 100)
        ];
    }
}
