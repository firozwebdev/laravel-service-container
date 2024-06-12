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
    Schema::create('faculties', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('user_id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->date('dob');
			$table->enum('gender', ['Male','Female','Other']);
			$table->text('address')->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('zip_code', 20)->nullable();
			$table->date('hire_date');
			$table->foreignId('department_id');
			$table->string('designation', 50);			
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
    Schema::dropIfExists('faculties');
  }
};