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
    Schema::create('questions', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('exam_id');
			$table->text('question_text');
			$table->enum('question_type', ['MCQ','TrueFalse','ShortAnswer','Essay']);
			$table->integer('marks');			
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
    Schema::dropIfExists('questions');
  }
};