<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'description' => $this->faker->paragraph(),
			'status' => $this->faker->randomElement(["Not Started","In Progress","Completed","Deferred"]),
			'due_date' => $this->faker->date(),
			'assigned_to' => $this->faker->numberBetween(1, 50),
			'created_at' => $this->faker->dateTime(),
			'updated_at' => $this->faker->dateTime()
        ];
    }
}
