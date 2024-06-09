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
    Schema::create('opportunities', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('lead_id');
			$table->string('name', 100);
			$table->float('amount', 8, 2);
			$table->enum('stage', ['Qualification','Needs Analysis','Proposal','Negotiation','Closed Won','Closed Lost'])->default('Qualification');
			$table->date('close_date')->nullable();
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
    Schema::dropIfExists('opportunities');
  }
};