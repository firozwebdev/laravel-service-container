<?php

namespace Database\Factories;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    public function definition()
    {
        return [
            'assignment_id' => $this->faker->numberBetween(1, 50),
			'student_id' => $this->faker->numberBetween(1, 50),
			'submitted_at' => $this->faker->dateTime(),
			'file_url' => $this->faker->sentence(),
			'grade' => $this->faker->numberBetween(0, 100),
			'feedback' => $this->faker->paragraph()
        ];
    }
}
