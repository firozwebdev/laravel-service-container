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
    Schema::create('employees', function (Blueprint $table) {
      $table->increments('id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('email', 100)->unique();
			$table->string('phone', 20)->nullable();
			$table->text('address')->nullable();
			$table->string('position', 50);
			$table->float('salary', 8, 2);
			$table->date('hire_date');
			$table->enum('status', ['Active','Inactive','Terminated'])->default('Active');			
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
    Schema::dropIfExists('employees');
  }
};