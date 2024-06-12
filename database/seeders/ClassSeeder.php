<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Class;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Class::factory()->count(50)->create();
    }
}
