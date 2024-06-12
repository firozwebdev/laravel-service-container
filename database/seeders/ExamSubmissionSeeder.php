<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamSubmission;

class ExamSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExamSubmission::factory()->count(50)->create();
    }
}
