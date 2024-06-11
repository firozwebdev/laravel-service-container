<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition()
    {
        return [
            'asset_name' => $this->faker->sentence(),
			'asset_type_id' => $this->faker->numberBetween(1, 50),
			'serial_number' => $this->faker->sentence(),
			'purchase_date' => $this->faker->date(),
			'warranty_expiration_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Active","In Maintenance","Retired"]),
			'assigned_to' => $this->faker->numberBetween(1, 50),
			'location' => $this->faker->sentence(),
			'price' => $this->faker->randomFloat(2, 0, 1000),
			'description' => $this->faker->paragraph()
        ];
    }
}
