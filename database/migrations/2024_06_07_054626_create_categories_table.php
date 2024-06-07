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
    Schema::create('categories', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('user_id')->unsigned();
			$table->string('name', 30);
			$table->text('description');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			
    });
  }

  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('categories');
  }
};