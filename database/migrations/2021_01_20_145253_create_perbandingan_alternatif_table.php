<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbandinganAlternatifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbandingan_alternatif', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('alternatif_id1');
            $table->foreign('alternatif_id1')->references('id')->on('alternatif')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('alternatif_id2');
            $table->foreign('alternatif_id2')->references('id')->on('alternatif')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('perbandingan_alternatif');
    }
}
