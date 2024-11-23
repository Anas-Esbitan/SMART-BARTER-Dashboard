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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // صاحب المنتج
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // التصنيف
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('price')->nullable();
            $table->string('image')->nullable(); // مسار صورة المنتج
            $table->enum('status', ['available', 'sold', 'swapped'])->default('available'); // حالة المنتج
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};