<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->date('booking_date')->after('room_id'); // إضافة عمود booking_date
            $table->time('booking_time')->after('booking_date'); // إضافة عمود booking_time
            $table->string('payment_method')->after('booking_time'); // إضافة عمود payment_method
        });
    }
    
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['booking_date', 'booking_time', 'payment_method']); // حذف الأعمدة في حالة التراجع
        });
    }
};
