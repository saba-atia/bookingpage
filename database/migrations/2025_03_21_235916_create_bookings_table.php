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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // ربط الحجز بالخدمة
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // ربط الحجز بالمستخدم (إذا كان لديك نظام مستخدمين)
            $table->date('booking_date'); // تاريخ الحجز
            $table->time('booking_time'); // وقت الحجز
            $table->string('status')->default('pending'); // حالة الحجز (مثلاً: pending, confirmed, cancelled)
            $table->timestamps(); // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
