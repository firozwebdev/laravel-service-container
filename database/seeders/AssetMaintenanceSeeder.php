<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetMaintenance;

class AssetMaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetMaintenance::factory()->count(50)->create();
    }
}
