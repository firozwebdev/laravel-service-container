<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
			'first_name' => $this->faker->firstName(),
			'last_name' => $this->faker->lastName(),
			'email' => $this->faker->unique()->safeEmail(),
			'phone' => $this->faker->phoneNumber(),
			'company' => $this->faker->company(),
			'position' => $this->faker->sentence()
        ];
    }
}
