<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {
        return [
            'module_id' => $this->faker->numberBetween(1, 50),
			'title' => $this->faker->sentence(),
			'content' => $this->faker->paragraph(),
			'video_url' => $this->faker->sentence(),
			'order' => $this->faker->numberBetween(0, 100)
        ];
    }
}
