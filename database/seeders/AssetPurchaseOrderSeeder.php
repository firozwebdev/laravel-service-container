<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetPurchaseOrder;

class AssetPurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetPurchaseOrder::factory()->count(50)->create();
    }
}
