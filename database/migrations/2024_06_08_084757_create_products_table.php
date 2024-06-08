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
    Schema::create('products', function (Blueprint $table) {
      $table->increments('id');
			$table->string('title', 25);
			$table->float('price', 4, 2);
			$table->text('description');
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
    Schema::dropIfExists('products');
  }
};