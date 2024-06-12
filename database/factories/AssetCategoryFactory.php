<?php

namespace Database\Factories;

use App\Models\AssetCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetCategoryFactory extends Factory
{
    protected $model = AssetCategory::class;

    public function definition()
    {
        return [
            'category_name' => $this->faker->sentence(),
			'description' => $this->faker->paragraph()
        ];
    }
}
