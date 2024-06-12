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
    Schema::create('events', function (Blueprint $table) {
      $table->increments('id');
			$table->string('name', 50);
			$table->text('description')->nullable();
			$table->date('date');
			$table->string('location', 100);
			$table->enum('status', ['Scheduled','Completed','Cancelled'])->default('Scheduled');			
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
    Schema::dropIfExists('events');
  }
};