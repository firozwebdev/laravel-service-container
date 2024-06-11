<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetLocation;

class AssetLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetLocation::factory()->count(50)->create();
    }
}
