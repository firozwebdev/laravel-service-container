<?php

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionFactory extends Factory
{
    protected $model = Option::class;

    public function definition()
    {
        return [
            'question_id' => $this->faker->numberBetween(1, 50),
			'option_text' => $this->faker->paragraph(),
			'is_correct' => $this->faker->boolean()
        ];
    }
}
