<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryToOrdersexampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('ordersexample', function (Blueprint $table) {
        $table->string('Country')->nullable(); // เพิ่มคอลัมน์ Country
    });
}

public function down()
{
    Schema::table('ordersexample', function (Blueprint $table) {
        $table->dropColumn('Country');
    });
}
}
