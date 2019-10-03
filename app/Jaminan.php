<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    protected $table = 'jaminan';

    public function dokumen()
    {
        return $this->belongsToMany('App\Dokumen', 'dokumen_jaminan', 'jaminan_id', 'dokumen_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        
        return $temp;
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setTanggalJaminanAttribute($value)
    {
        $this->attributes['tanggal_jaminan'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setTanggalJatuhTempoAttribute($value)
    {
        $this->attributes['tanggal_jatuh_tempo'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function getTanggalAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getTanggalJaminanAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }


    public function getTanggalJatuhTempoAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getNomorAttribute($value)
    {
        $value = str_pad($value, 4, '0', STR_PAD_LEFT);
        return $value;
    }

    // public function getJumlahAttribute($value)
    // {
    //     $value = strlen($value)? number_format($value,0,",",".") : null;

    //     return $value;
    // }
}
