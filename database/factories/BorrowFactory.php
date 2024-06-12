<?php

namespace Database\Factories;

use App\Models\Borrow;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowFactory extends Factory
{
    protected $model = Borrow::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 50),
			'book_id' => $this->faker->numberBetween(1, 50),
			'borrow_date' => $this->faker->date(),
			'return_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Borrowed","Returned","Overdue"])
        ];
    }
}
