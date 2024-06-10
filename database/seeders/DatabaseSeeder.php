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
        
       

		$this->call(CategorySeeder::class);

		$this->call(TaskSeeder::class);

		$this->call(PostSeeder::class);

		$this->call(ProductSeeder::class);

		$this->call(OrderItemSeeder::class);

		$this->call(LeadSeeder::class);

	}
}
