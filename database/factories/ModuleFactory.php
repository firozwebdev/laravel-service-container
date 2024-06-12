<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition()
    {
        return [
            'course_id' => $this->faker->numberBetween(1, 50),
			'title' => $this->faker->sentence(),
			'description' => $this->faker->paragraph(),
			'order' => $this->faker->numberBetween(0, 100)
        ];
    }
}
