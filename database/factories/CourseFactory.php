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
            'title' => $this->faker->sentence(),
			'description' => $this->faker->paragraph(),
			'instructor_id' => $this->faker->numberBetween(1, 50),
			'start_date' => $this->faker->date(),
			'end_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Planned","Active","Completed"])
        ];
    }
}
