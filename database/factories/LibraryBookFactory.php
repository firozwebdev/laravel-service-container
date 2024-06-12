<?php

namespace Database\Factories;

use App\Models\LibraryBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryBookFactory extends Factory
{
    protected $model = LibraryBook::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
			'author' => $this->faker->sentence(),
			'isbn' => $this->faker->sentence(),
			'category' => $this->faker->sentence(),
			'status' => $this->faker->randomElement(["Available","Borrowed","Reserved"])
        ];
    }
}
