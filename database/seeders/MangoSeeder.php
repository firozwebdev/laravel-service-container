<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mango;

class MangoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Mango::factory()->count(50)->create();
    }
}
