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

		$this->call(StudentSeeder::class);

		$this->call(FacultySeeder::class);

		$this->call(DepartmentSeeder::class);

		$this->call(ProgramSeeder::class);

		$this->call(CourseSeeder::class);

		$this->call(EnrollmentSeeder::class);

		
		$this->call(AttendanceSeeder::class);

		$this->call(ExamSeeder::class);

		$this->call(ResultSeeder::class);

		$this->call(FeeSeeder::class);

		$this->call(PaymentSeeder::class);

		$this->call(EventSeeder::class);

		$this->call(LibraryBookSeeder::class);

		$this->call(BorrowSeeder::class);

		$this->call(HostelSeeder::class);

		$this->call(RoomSeeder::class);

		$this->call(HostelAllocationSeeder::class);

		$this->call(TransportSeeder::class);

		$this->call(TransportAllocationSeeder::class);

	}
}
