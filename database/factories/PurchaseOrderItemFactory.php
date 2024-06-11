<?php

namespace Database\Factories;

use App\Models\PurchaseOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderItemFactory extends Factory
{
    protected $model = PurchaseOrderItem::class;

    public function definition()
    {
        return [
            'purchase_order_id' => $this->faker->numberBetween(1, 50),
			'asset_id' => $this->faker->numberBetween(1, 50),
			'quantity' => $this->faker->numberBetween(0, 100),
			'price' => $this->faker->randomFloat(2, 0, 1000),
			'total' => $this->faker->randomFloat(2, 0, 1000)
        ];
    }
}
