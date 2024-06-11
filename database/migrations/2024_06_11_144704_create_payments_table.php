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
    Schema::create('payments', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('order_id');
			$table->float('amount', 8, 2);
			$table->string('payment_method', 50);
			$table->enum('payment_status', ['Pending','Completed','Failed'])->default('Pending');			
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
    Schema::dropIfExists('payments');
  }
};