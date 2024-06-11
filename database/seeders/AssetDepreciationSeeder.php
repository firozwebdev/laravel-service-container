<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetDepreciation;

class AssetDepreciationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetDepreciation::factory()->count(50)->create();
    }
}
