<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LibraryBook;

class LibraryBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LibraryBook::factory()->count(50)->create();
    }
}
