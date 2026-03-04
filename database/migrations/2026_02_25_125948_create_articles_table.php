<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('articles', function (Blueprint $table) {
    $table->id();
    // Use foreignId for automatic type matching
    $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
    $table->string('title');
    $table->text('body');
    $table->string('author_email');
    $table->string('image_url')->nullable();
    $table->string('status')->default('draft');
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
