<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'description' => $this->faker->paragraph(),
			'date' => $this->faker->date(),
			'location' => $this->faker->sentence(),
			'status' => $this->faker->randomElement(["Scheduled","Completed","Cancelled"])
        ];
    }
}
