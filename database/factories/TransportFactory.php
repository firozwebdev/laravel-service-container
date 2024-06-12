<?php

namespace Database\Factories;

use App\Models\Transport;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportFactory extends Factory
{
    protected $model = Transport::class;

    public function definition()
    {
        return [
            'vehicle_number' => $this->faker->sentence(),
			'driver_name' => $this->faker->sentence(),
			'route' => $this->faker->sentence(),
			'capacity' => $this->faker->numberBetween(0, 100)
        ];
    }
}
