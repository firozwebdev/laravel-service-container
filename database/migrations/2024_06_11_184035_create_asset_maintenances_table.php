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
    Schema::create('asset_maintenances', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('asset_id');
			$table->date('maintenance_date');
			$table->enum('maintenance_type', ['Scheduled','Unscheduled'])->default('Scheduled');
			$table->text('description')->nullable();
			$table->float('cost', 8, 2)->nullable();
			$table->enum('status', ['Pending','Completed','In Progress'])->default('Pending');			
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
    Schema::dropIfExists('asset_maintenances');
  }
};