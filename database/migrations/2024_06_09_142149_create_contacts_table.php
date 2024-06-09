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
    Schema::create('contacts', function (Blueprint $table) {
      $table->increments('id');
			$table->string('name');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('email', 100)->unique();
			$table->string('phone', 20)->nullable();
			$table->string('company', 100)->nullable();
			$table->string('position', 50)->nullable();
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			
      $table->softDeletes();
    });
  }

  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('contacts');
  }
};