<?php

namespace Database\Factories;

use App\Models\Fee;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeeFactory extends Factory
{
    protected $model = Fee::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 50),
			'amount' => $this->faker->randomFloat(2, 0, 1000),
			'due_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Paid","Unpaid","Overdue"])
        ];
    }
}
