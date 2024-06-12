<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
    	
		


		

		$this->call(UserSeeder::class);

		$this->call(ProfileSeeder::class);

		$this->call(CourseSeeder::class);

		$this->call(ModuleSeeder::class);

		$this->call(LessonSeeder::class);

		$this->call(AssignmentSeeder::class);

		$this->call(SubmissionSeeder::class);

		$this->call(ExamSeeder::class);

		$this->call(QuestionSeeder::class);

		$this->call(OptionSeeder::class);

		$this->call(ExamSubmissionSeeder::class);

		$this->call(AnswerSeeder::class);

		$this->call(GradeSeeder::class);

		$this->call(CommentSeeder::class);

		$this->call(NotificationSeeder::class);

	}
}
