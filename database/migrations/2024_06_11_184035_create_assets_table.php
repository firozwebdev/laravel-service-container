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
    Schema::create('assets', function (Blueprint $table) {
      $table->increments('id');
			$table->string('asset_name', 100);
			$table->foreignId('asset_type_id');
			$table->string('serial_number', 100)->unique();
			$table->date('purchase_date');
			$table->date('warranty_expiration_date')->nullable();
			$table->enum('status', ['Active','In Maintenance','Retired'])->default('Active');
			$table->foreignId('assigned_to')->nullable();
			$table->string('location', 100)->nullable();
			$table->float('price', 8, 2);
			$table->text('description')->nullable();			
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
    Schema::dropIfExists('assets');
  }
};