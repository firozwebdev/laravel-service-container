<?php

namespace Database\Factories;

use App\Models\TransportAllocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportAllocationFactory extends Factory
{
    protected $model = TransportAllocation::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 50),
			'transport_id' => $this->faker->numberBetween(1, 50),
			'allocation_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Active","Inactive"])
        ];
    }
}
