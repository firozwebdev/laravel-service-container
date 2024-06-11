<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paymnet;

class PaymnetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paymnet::factory()->count(50)->create();
    }
}
