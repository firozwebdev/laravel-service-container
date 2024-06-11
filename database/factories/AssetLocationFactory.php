<?php

namespace Database\Factories;

use App\Models\AssetLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetLocationFactory extends Factory
{
    protected $model = AssetLocation::class;

    public function definition()
    {
        return [
            'location_name' => $this->faker->sentence(),
			'description' => $this->faker->paragraph()
        ];
    }
}
