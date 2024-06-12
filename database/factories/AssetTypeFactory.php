<?php

namespace Database\Factories;

use App\Models\AssetType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetTypeFactory extends Factory
{
    protected $model = AssetType::class;

    public function definition()
    {
        return [
            'type_name' => $this->faker->sentence(),
			'description' => $this->faker->paragraph()
        ];
    }
}
