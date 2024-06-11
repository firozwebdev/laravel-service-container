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
    Schema::create('purchase_order_items', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('purchase_order_id');
			$table->foreignId('asset_id')->nullable();
			$table->integer('quantity');
			$table->float('price', 8, 2);
			$table->float('total', 8, 2);			
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
    Schema::dropIfExists('purchase_order_items');
  }
};