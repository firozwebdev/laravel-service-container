<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'discussion_id' => $this->faker->numberBetween(1, 50),
			'user_id' => $this->faker->numberBetween(1, 50),
			'content' => $this->faker->paragraph(),
			'created_at' => $this->faker->dateTime(),
			'updated_at' => $this->faker->dateTime()
        ];
    }
}
