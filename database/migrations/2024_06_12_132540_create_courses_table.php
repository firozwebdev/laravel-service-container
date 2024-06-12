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
    Schema::create('courses', function (Blueprint $table) {
      $table->increments('id');
			$table->string('title', 100);
			$table->text('description')->nullable();
			$table->foreignId('instructor_id');
			$table->date('start_date');
			$table->date('end_date')->nullable();
			$table->enum('status', ['Planned','Active','Completed'])->default('Planned');			
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
    Schema::dropIfExists('courses');
  }
};