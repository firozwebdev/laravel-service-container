<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->sentence(),
			'email' => $this->faker->unique()->safeEmail(),
			'password' => $this->faker->password(),
			'role' => $this->faker->randomElement(["Admin","Faculty","Student","Staff"])
        ];
    }
}
