<?php

namespace Database\Factories;

use App\Models\Hostel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostelFactory extends Factory
{
    protected $model = Hostel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'location' => $this->faker->sentence(),
			'total_rooms' => $this->faker->numberBetween(0, 100)
        ];
    }
}
