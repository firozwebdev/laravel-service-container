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
        
    	
		

		$this->call(AssetTypeSeeder::class);

		$this->call(AssetCategorySeeder::class);

		$this->call(AssetMaintenanceSeeder::class);

		$this->call(ContactSeeder::class);

		$this->call(TaskSeeder::class);

		$this->call(SupplierSeeder::class);

		$this->call(EmployeeSeeder::class);

		$this->call(AssetSeeder::class);

		$this->call(ReminderSeeder::class);

		$this->call(AssignmentSeeder::class);

		$this->call(StudentSeeder::class);

		$this->call(CustomerSeeder::class);

		$this->call(OrderItemSeeder::class);

		$this->call(PaymnetSeeder::class);

		$this->call(TestSeeder::class);

		$this->call(PaymentSeeder::class);

	}
}
