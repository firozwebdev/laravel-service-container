<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransportAllocation;

class TransportAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportAllocation::factory()->count(50)->create();
    }
}
