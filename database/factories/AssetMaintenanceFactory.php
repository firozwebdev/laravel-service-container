<?php

namespace Database\Factories;

use App\Models\AssetMaintenance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetMaintenanceFactory extends Factory
{
    protected $model = AssetMaintenance::class;

    public function definition()
    {
        return [
            'asset_id' => $this->faker->numberBetween(1, 50),
			'maintenance_date' => $this->faker->date(),
			'maintenance_type' => $this->faker->randomElement(["Scheduled","Unscheduled"]),
			'description' => $this->faker->paragraph(),
			'cost' => $this->faker->randomFloat(2, 0, 1000),
			'status' => $this->faker->randomElement(["Pending","Completed","In Progress"])
        ];
    }
}
