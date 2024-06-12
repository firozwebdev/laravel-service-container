<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 50),
			'class_id' => $this->faker->numberBetween(1, 50),
			'date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Present","Absent","Late"])
        ];
    }
}
