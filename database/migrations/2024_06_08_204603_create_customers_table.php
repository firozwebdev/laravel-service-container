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
    Schema::create('customers', function (Blueprint $table) {
      $table->increments('id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('email', 100)->unique();
			$table->string('phone', 20)->nullable();
			$table->text('address')->nullable();
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
    Schema::dropIfExists('customers');
  }
};