<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoPhanhoi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phanhoi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('Users');
            $table->string('NoiDung');
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
        Schema::dropIfExists('phanhoi');
    }
}
