<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'exam_id' => $this->faker->numberBetween(1, 50),
			'question_text' => $this->faker->paragraph(),
			'question_type' => $this->faker->randomElement(["MCQ","TrueFalse","ShortAnswer","Essay"]),
			'marks' => $this->faker->numberBetween(0, 100)
        ];
    }
}
