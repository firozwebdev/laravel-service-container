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
			$table->foreignId('user_id');
			$table->string('name', 100);
			$table->text('description');
			$table->float('price', 4, 2);
			$table->integer('stock');
			$table->foreignId('category_id');			
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
    Schema::dropIfExists('products');
  }
};