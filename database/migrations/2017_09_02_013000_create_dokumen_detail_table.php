<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dokumen_id')->unsigned();
            $table->string('uraian_barang');
            $table->string('hs_code');
            $table->string('harga_jenis')->nullable();
            $table->decimal('harga_barang',18,2);
            $table->decimal('freight',18,2);
            $table->decimal('asuransi',18,2);
            $table->decimal('cif',18,2);
            $table->decimal('kurs_nilai',18,4);
            $table->string('kurs_label');
            $table->decimal('nilai_pabean',18,2);
            $table->string('catatan_pemeriksa');
            $table->decimal('trf_bm',5,1);
            $table->decimal('trf_ppn',5,1);
            $table->decimal('trf_ppnbm',5,1);
            $table->decimal('trf_pph',5,1);
            $table->decimal('bayar_bm',18,2);
            $table->decimal('bayar_ppn',18,2);
            $table->decimal('bayar_ppnbm',18,2);
            $table->decimal('bayar_pph',18,2);
            $table->decimal('bayar_total',18,2);
            $table->decimal('ditanggung_pmrnth_bm',18,2);
            $table->decimal('ditanggung_pmrnth_ppn',18,2);
            $table->decimal('ditanggung_pmrnth_ppnbm',18,2);
            $table->decimal('ditanggung_pmrnth_pph',18,2);
            $table->decimal('ditanggung_pmrnth_total',18,2);
            $table->decimal('ditangguhkan_bm',18,2);
            $table->decimal('ditangguhkan_ppn',18,2);
            $table->decimal('ditangguhkan_ppnbm',18,2);
            $table->decimal('ditangguhkan_pph',18,2);
            $table->decimal('ditangguhkan_total',18,2);
            $table->decimal('dibebaskan_bm',18,2);
            $table->decimal('dibebaskan_ppn',18,2);
            $table->decimal('dibebaskan_ppnbm',18,2);
            $table->decimal('dibebaskan_pph',18,2);
            $table->decimal('dibebaskan_total',18,2);
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
        Schema::dropIfExists('dokumen_detail');
    }
}
