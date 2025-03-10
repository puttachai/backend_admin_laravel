<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('user_activity', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        $table->string('page_url'); // URL ของหน้าที่เข้าชม
        $table->string('action')->nullable(); // กิจกรรมที่ทำ เช่น "view", "click", "update"
        $table->ipAddress('ip_address'); // บันทึก IP ของผู้ใช้
        $table->text('user_agent')->nullable(); // ข้อมูล Browser / Device
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activity');
    }
}
