<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetType;

class AssetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetType::factory()->count(50)->create();
    }
}
