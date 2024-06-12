<?php

namespace Database\Factories;

use App\Models\HostelAllocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostelAllocationFactory extends Factory
{
    protected $model = HostelAllocation::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 50),
			'room_id' => $this->faker->numberBetween(1, 50),
			'allocation_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Active","Inactive"])
        ];
    }
}
