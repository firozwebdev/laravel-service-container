<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
    	
		


		$this->call(AssetSeeder::class);

		$this->call(AssetTypeSeeder::class);

		$this->call(AssetCategorySeeder::class);

		$this->call(AssetMaintenanceSeeder::class);

		$this->call(AssetDepreciationSeeder::class);

		$this->call(AssetLocationSeeder::class);

		$this->call(SupplierSeeder::class);

		$this->call(AssetPurchaseOrderSeeder::class);

		$this->call(PurchaseOrderItemSeeder::class);

		$this->call(ProductSeeder::class);

		$this->call(PostSeeder::class);

	}
}
