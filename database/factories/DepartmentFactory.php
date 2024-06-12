<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'description' => $this->faker->paragraph(),
			'head_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
