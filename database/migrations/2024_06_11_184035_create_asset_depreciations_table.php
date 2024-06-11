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
    Schema::create('asset_depreciations', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('asset_id');
			$table->date('depreciation_date');
			$table->float('depreciation_amount', 8, 2);
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
    Schema::dropIfExists('asset_depreciations');
  }
};