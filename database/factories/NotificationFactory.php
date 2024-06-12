<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
			'message' => $this->faker->paragraph(),
			'is_read' => $this->faker->boolean(),
			'created_at' => $this->faker->dateTime()
        ];
    }
}
