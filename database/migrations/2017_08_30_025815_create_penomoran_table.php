<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenomoranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penomoran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('kode');
            $table->string('label')->nullable();
            $table->string('tahun'); //ganti manual column ke year
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('penomoran');
    }
}
