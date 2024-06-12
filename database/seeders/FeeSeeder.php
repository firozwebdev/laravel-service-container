<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fee;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fee::factory()->count(50)->create();
    }
}
