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
    Schema::create('tasks', function (Blueprint $table) {
      $table->increments('id');
			$table->string('name', 100);
			$table->text('description')->nullable();
			$table->enum('status', ['Not Started','In Progress','Completed','Deferred'])->default('Not Started');
			$table->date('due_date')->nullable();
			$table->foreignId('assigned_to')->nullable();			
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
    Schema::dropIfExists('tasks');
  }
};