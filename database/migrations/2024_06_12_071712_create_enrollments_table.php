<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
  /**
  * Run the migrations.  */
  public function up(): void
  {
    Schema::create('enrollments', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('student_id');
			$table->foreignId('course_id');
			$table->date('enrollment_date');
			$table->enum('status', ['Active','Completed','Withdrawn'])->default('Active');			
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
      $table->softDeletes();
    });
  }

  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('enrollments');
  }
};