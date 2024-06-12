<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HostelAllocation;

class HostelAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HostelAllocation::factory()->count(50)->create();
    }
}
