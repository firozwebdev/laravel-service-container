<?php

namespace Database\Factories;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityFactory extends Factory
{
    protected $model = Opportunity::class;

    public function definition()
    {
        return [
            'lead_id' => $this->faker->numberBetween(1, 50),
			'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'amount' => $this->faker->randomFloat(2, 0, 1000),
			'stage' => $this->faker->randomElement(["Qualification","Needs Analysis","Proposal","Negotiation","Closed Won","Closed Lost"]),
			'close_date' => $this->faker->date(),
			'created_at' => $this->faker->dateTime(),
			'updated_at' => $this->faker->dateTime()
        ];
    }
}
