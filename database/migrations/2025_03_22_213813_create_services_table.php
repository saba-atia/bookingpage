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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الخدمة
            $table->text('description'); // وصف الخدمة
            $table->decimal('price', 8, 2); // سعر الخدمة
            $table->boolean('is_available')->default(true); // حالة التوفر
            $table->string('room_type')->nullable(); // نوع الغرفة (فردي، زوجي، جناح)
            $table->boolean('breakfast')->default(false); // إفطار
            $table->boolean('lunch')->default(false); // غداء
            $table->boolean('dinner')->default(false); // عشاء
            $table->boolean('room_service')->default(false); // خدمة الغرف
            $table->boolean('parking')->default(false); // موقف سيارات
            $table->boolean('wifi')->default(false); // إنترنت مجاني
            $table->boolean('gym')->default(false); // صالة رياضية
            $table->boolean('pool')->default(false); // مسبح

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
