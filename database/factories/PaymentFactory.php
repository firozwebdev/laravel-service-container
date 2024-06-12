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
            'fee_id' => $this->faker->numberBetween(1, 50),
			'amount' => $this->faker->randomFloat(2, 0, 1000),
			'payment_date' => $this->faker->date(),
			'payment_method' => $this->faker->randomElement(["Cash","Credit Card","Bank Transfer"])
        ];
    }
}
