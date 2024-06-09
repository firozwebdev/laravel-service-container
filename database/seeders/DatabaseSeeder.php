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
        
    	

		$this->call(PostSeeder::class);

		
		$this->call(CustomerSeeder::class);

		$this->call(PaymentSeeder::class);

		$this->call(LeadSeeder::class);

	}
}
