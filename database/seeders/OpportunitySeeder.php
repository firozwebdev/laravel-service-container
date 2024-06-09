<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Opportunity;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Opportunity::factory()->count(50)->create();
    }
}
