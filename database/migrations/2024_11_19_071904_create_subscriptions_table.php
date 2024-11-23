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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // المستخدم المرتبط
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active'); // حالة الاشتراك
            $table->decimal('price', 8, 2); // تكلفة الاشتراك
            $table->string('subscription_type'); // نوع الاشتراك (شهري، سنوي، إلخ)
            $table->date('start_date'); // بداية الاشتراك
            $table->date('end_date'); // نهاية الاشتراك
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};