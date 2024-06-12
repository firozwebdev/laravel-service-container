<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'description' => $this->faker->paragraph(),
			'credits' => $this->faker->numberBetween(0, 100),
			'department_id' => $this->faker->numberBetween(1, 50),
			'program_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
