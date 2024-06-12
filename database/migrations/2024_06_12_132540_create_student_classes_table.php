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
    Schema::create('student_classes', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('course_id');
			$table->foreignId('faculty_id');
			$table->string('semester', 20);
			$table->integer('year');			
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
    Schema::dropIfExists('student_classes');
  }
};