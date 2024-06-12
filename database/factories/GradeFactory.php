<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition()
    {
        return [
            'course_id' => $this->faker->numberBetween(1, 50),
			'student_id' => $this->faker->numberBetween(1, 50),
			'grade' => $this->faker->sentence(),
			'remarks' => $this->faker->paragraph()
        ];
    }
}
