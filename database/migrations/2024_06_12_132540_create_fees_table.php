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
    Schema::create('fees', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('student_id');
			$table->decimal('amount', 10, 2);
			$table->date('due_date');
			$table->enum('status', ['Paid','Unpaid','Overdue'])->default('Unpaid');			
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
    Schema::dropIfExists('fees');
  }
};