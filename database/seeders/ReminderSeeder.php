<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reminder;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reminder::factory()->count(50)->create();
    }
}
