<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition()
    {
        return [
            'exam_submission_id' => $this->faker->numberBetween(1, 50),
			'question_id' => $this->faker->numberBetween(1, 50),
			'answer_text' => $this->faker->paragraph(),
			'marks_obtained' => $this->faker->numberBetween(0, 100)
        ];
    }
}
