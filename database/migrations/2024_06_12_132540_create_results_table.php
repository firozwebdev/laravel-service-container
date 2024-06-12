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
    Schema::create('results', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('student_id');
			$table->foreignId('exam_id');
			$table->integer('marks_obtained');
			$table->string('grade', 2);			
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
    Schema::dropIfExists('results');
  }
};