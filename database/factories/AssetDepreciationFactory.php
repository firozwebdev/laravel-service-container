<?php

namespace Database\Factories;

use App\Models\AssetDepreciation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetDepreciationFactory extends Factory
{
    protected $model = AssetDepreciation::class;

    public function definition()
    {
        return [
            'asset_id' => $this->faker->numberBetween(1, 50),
			'depreciation_date' => $this->faker->date(),
			'depreciation_amount' => $this->faker->randomFloat(2, 0, 1000),
			'description' => $this->faker->paragraph()
        ];
    }
}
