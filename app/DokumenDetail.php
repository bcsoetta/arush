<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenDetail extends Model
{
    protected $table = 'dokumen_detail';

    public function dokumen()
    {
        return $this->belongTo('App\Dokumen');
    }

    // //SET TO DATABASE
    // public function getHargaBarangAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getFreightAttribute($value)
    // {
    //     return $value;
    // }

    // public function getAsuransiAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getCifAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getNilaiPabeanAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getTrfBmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,1,",",".") : null;

    //     return $value;
    // }

    // public function getTrfPpnAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,1,",",".") : null;

    //     return $value;
    // }

    // public function getTrfPpnbmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,1,",",".") : null;

    //     return $value;
    // }

    // public function getTrfPphAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,1,",",".") : null;

    //     return $value;
    // }

    // public function getBayarBmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getBayarPpnAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getBayarPpnbmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getBayarPphAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getBayarTotalAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitanggungPmrnthBmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitanggungPmrnthPpnAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }
    // public function getDitanggungPmrnthPpnbmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }
    // public function getDitanggungPmrnthPphAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitanggungPmrnthTotalAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitangguhkanBmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitangguhkanPpnAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitangguhkanPpnbmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitangguhkanPphAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDitangguhkanTotalAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDibebaskanBmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }

    // public function getDibebaskanPpnAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }
    // public function getDibebaskanPpnbmAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }
    // public function getDibebaskanPphAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }
    // public function getDibebaskanTotalAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,2,",",".") : null;

    //     return $value;
    // }




}
