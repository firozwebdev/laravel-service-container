<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 50),
			'title' => $this->faker->sentence(),
			'image' => $this->faker->imageUrl(640, 480, "animals", true),
			'status' => $this->faker->randomElement(["Active","Inactive","Pending","Deleted"]),
			'description' => $this->faker->paragraph()
        ];
    }
}
