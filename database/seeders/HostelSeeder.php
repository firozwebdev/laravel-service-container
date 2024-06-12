<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hostel::factory()->count(50)->create();
    }
}
