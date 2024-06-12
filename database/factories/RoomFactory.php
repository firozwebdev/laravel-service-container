<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'hostel_id' => $this->faker->numberBetween(1, 50),
			'room_number' => $this->faker->sentence(),
			'capacity' => $this->faker->numberBetween(0, 100),
			'status' => $this->faker->randomElement(["Available","Occupied","Maintenance"])
        ];
    }
}
