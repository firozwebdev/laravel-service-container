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
    Schema::create('library_books', function (Blueprint $table) {
      $table->increments('id');
			$table->string('title', 100);
			$table->string('author', 50);
			$table->string('isbn', 20)->unique();
			$table->string('category', 50);
			$table->enum('status', ['Available','Borrowed','Reserved'])->default('Available');			
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
    Schema::dropIfExists('library_books');
  }
};