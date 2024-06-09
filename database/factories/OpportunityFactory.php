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
            'lead_id' => $this->faker->word,
			'name' => $this->faker->firstName(),
			'amount' => $this->faker->word,
			'stage' => $this->faker->word,
			'close_date' => $this->faker->word,
			'created_at' => $this->faker->dateTime(),
			'updated_at' => $this->faker->dateTime()
        ];
    }
}
