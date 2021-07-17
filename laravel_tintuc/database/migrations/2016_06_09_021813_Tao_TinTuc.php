<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class TaoTinTuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TinTuc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TieuDe');
            $table->string('TieuDeKhongDau');
            $table->text('TomTat');
            $table->longText('NoiDung');
            $table->string('Hinh');
            $table->integer('NoiBat')->default(0);
            $table->integer('SoLuotXem')->default(0);
            $table->integer('idLoaiTin')->unsigned();
            $table->foreign('idLoaiTin')->references('id')->on('LoaiTin');
            $table->timestamps();

            // hm viet them
            $table->enum('ghimTin', ['ghim', 'khongghim'])->default('khongghim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('TinTuc');
    }
}
