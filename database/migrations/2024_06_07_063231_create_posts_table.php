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
    Schema::create('posts', function (Blueprint $table) {
      $table->increments('id');
			$table->foreignId('category_id');
			$table->string('title');
			$table->enum('post_status', ['Active','Inactive','Pending','Deleted'])->default('Active');
			$table->text('description')->nullable();
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			
    });
  }

  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('posts');
  }
};