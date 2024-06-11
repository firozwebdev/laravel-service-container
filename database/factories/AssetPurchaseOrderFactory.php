<?php

namespace Database\Factories;

use App\Models\AssetPurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetPurchaseOrderFactory extends Factory
{
    protected $model = AssetPurchaseOrder::class;

    public function definition()
    {
        return [
            'supplier_id' => $this->faker->numberBetween(1, 50),
			'order_date' => $this->faker->date(),
			'delivery_date' => $this->faker->date(),
			'status' => $this->faker->randomElement(["Pending","Completed","Cancelled"]),
			'total_amount' => $this->faker->randomFloat(2, 0, 1000),
			'remarks' => $this->faker->paragraph()
        ];
    }
}
