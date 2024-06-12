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
    Schema::create('borrows', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('student_id');
			$table->foreignId('book_id');
			$table->date('borrow_date');
			$table->date('return_date')->nullable();
			$table->enum('status', ['Borrowed','Returned','Overdue'])->default('Borrowed');			
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
    Schema::dropIfExists('borrows');
  }
};