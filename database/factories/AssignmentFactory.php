<?php

namespace Database\Factories;

use App\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    protected $model = Assignment::class;

    public function definition()
    {
        return [
            'course_id' => $this->faker->numberBetween(1, 50),
			'title' => $this->faker->sentence(),
			'description' => $this->faker->paragraph(),
			'due_date' => $this->faker->date()
        ];
    }
}
