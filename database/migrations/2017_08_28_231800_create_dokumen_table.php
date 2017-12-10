<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('daftar_no')->nullable();
            $table->date('daftar_tgl')->nullable();
            $table->integer('importir_id')->nullable();
            $table->string('importir_npwp');
            $table->string('importir_nm');
            $table->string('importir_alamat');
            $table->integer('ppjk_id')->nullable();
            $table->string('ppjk_npwp');
            $table->string('ppjk_nm');
            $table->string('ppjk_alamat');
            $table->integer('srn_angkut_id')->nullable();
            $table->string('srn_angkut_kd');
            $table->string('srn_angkut_nm');
            $table->date('tiba_tgl');
            $table->string('mawb_no');
            $table->date('mawb_tgl');
            $table->string('hawb_no')->nullable();
            $table->date('hawb_tgl')->nullable();
            $table->string('bc11_no')->nullable();
            $table->string('bc11_pos')->nullable();
            $table->string('bc11_sub')->nullable();
            $table->date('bc11_tgl')->nullable();
            $table->decimal('kmsn_jmlh', 10, 2);
            $table->string('kmsn_satuan');
            $table->decimal('brutto', 10, 2);
            $table->decimal('netto', 10, 2);
            $table->integer('lokasi_id')->nullable();
            $table->string('lokasi_nama');
            $table->integer('jaminan_id')->nullable();
            $table->string('jaminan_jns')->nullable();;
            $table->string('jaminan_nomor')->nullable();
            $table->date('jaminan_tgl')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('status_label')->nullable();
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
        Schema::dropIfExists('dokumen');
    }
}
