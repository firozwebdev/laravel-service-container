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
    Schema::create('suppliers', function (Blueprint $table) {
      $table->increments('id');
			$table->string('name', 100);
			$table->string('email', 100)->nullable()->unique();
			$table->string('phone', 20)->nullable();
			$table->text('address')->nullable();			
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
    Schema::dropIfExists('suppliers');
  }
};