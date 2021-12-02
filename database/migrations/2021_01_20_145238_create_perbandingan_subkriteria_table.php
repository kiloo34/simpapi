<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbandinganSubkriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbandingan_subkriteria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subkriteria_id1');
            $table->foreign('subkriteria_id1')->references('id')->on('subkriteria')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('subkriteria_id2');
            $table->foreign('subkriteria_id2')->references('id')->on('subkriteria')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('perbandingan_subkriteria');
    }
}
