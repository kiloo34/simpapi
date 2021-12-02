<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbandinganKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbandingan_kategori', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kategori_id1');
            $table->foreign('kategori_id1')->references('id')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_id2');
            $table->foreign('kategori_id2')->references('id')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode');
            $table->string('nilai');
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
        Schema::dropIfExists('perbandingan_kategori');
    }
}
