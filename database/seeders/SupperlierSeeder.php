<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supperlier;

class SupperlierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supperlier::factory()->count(50)->create();
    }
}
