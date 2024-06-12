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
			$table->foreignId('fee_id');
			$table->decimal('amount', 10, 2);
			$table->date('payment_date');
			$table->enum('payment_method', ['Cash','Credit Card','Bank Transfer'])->default('Cash');			
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