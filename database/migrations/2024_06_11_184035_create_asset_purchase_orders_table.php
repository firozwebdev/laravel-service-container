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
    Schema::create('asset_purchase_orders', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('supplier_id');
			$table->date('order_date');
			$table->date('delivery_date')->nullable();
			$table->enum('status', ['Pending','Completed','Cancelled'])->default('Pending');
			$table->float('total_amount', 8, 2);
			$table->text('remarks')->nullable();			
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
    Schema::dropIfExists('asset_purchase_orders');
  }
};