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
    Schema::create('submissions', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('assignment_id');
			$table->foreignId('student_id');
			$table->timestamp('submitted_at');
			$table->string('file_url', 255)->nullable();
			$table->integer('grade')->nullable();
			$table->text('feedback')->nullable();			
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
    Schema::dropIfExists('submissions');
  }
};