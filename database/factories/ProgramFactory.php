<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    protected $model = Program::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'description' => $this->faker->paragraph(),
			'department_id' => $this->faker->numberBetween(1, 50),
			'duration' => $this->faker->numberBetween(0, 100)
        ];
    }
}
