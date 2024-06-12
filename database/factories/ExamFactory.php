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
            'course_id' => $this->faker->numberBetween(1, 50),
			'title' => $this->faker->sentence(),
			'description' => $this->faker->paragraph(),
			'date' => $this->faker->date(),
			'total_marks' => $this->faker->numberBetween(0, 100)
        ];
    }
}
