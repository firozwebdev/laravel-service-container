<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 50),
			'amount' => $this->faker->randomFloat(2, 0, 1000),
			'payment_method' => $this->faker->sentence(),
			'payment_status' => $this->faker->randomElement(["Pending","Completed","Failed"]),
			'created_at' => $this->faker->dateTime(),
			'updated_at' => $this->faker->dateTime()
        ];
    }
}
