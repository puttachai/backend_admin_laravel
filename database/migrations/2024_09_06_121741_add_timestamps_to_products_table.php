<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->timestamps(); // เพิ่มคอลัมน์ created_at และ updated_at
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropTimestamps(); // ลบคอลัมน์ created_at และ updated_at
    });
}
}
