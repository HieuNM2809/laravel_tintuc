<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableThongke extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongke', function (Blueprint $table) {
            $table->increments('id');
            $table->date('ngaythangnam')->nullable();
            $table->date('thangnam')->nullable();
            $table->integer('luotxemngay')->default(0);
            $table->integer('luotxemthang')->default(0);
            $table->integer('phanhoingay')->default(0);
            $table->integer('phanhoithang')->default(0);
            $table->integer('dangkyngay')->default(0);
            $table->integer('dangkythang')->default(0);
            $table->integer('commentngay')->default(0);
            $table->integer('commentthang')->default(0);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongke');
    }
}
