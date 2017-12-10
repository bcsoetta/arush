<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('nilai', 10, 4);
            $table->string('code');
            $table->string('label');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
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
        Schema::dropIfExists('kurs');
    }
}
