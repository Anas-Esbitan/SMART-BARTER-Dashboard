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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->string('First_name', 50)->nullable(); 
            $table->string('Last_name', 50)->nullable(); 
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('phone_number', 15)->nullable();
            $table->enum('role', ['user', 'admin'])->default('admin');
            $table->text('address')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropSoftDeletes();
        Schema::dropIfExists('users');
    }
};
