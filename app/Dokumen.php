<?php

namespace App;

use Carbon\carbon;
use App\Penomoran;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    //
    public function detail()
    {
        return $this->hasMany('App\DokumenDetail');
    }

    public function ip()
    {
        return $this->hasOne('App\Ip')->latest();
    }

    public function lhp()
    {
        return $this->hasOne('App\Lhp')->latest();
    }

    public function perhitunganJaminan()
    {
        return $this->hasOne('App\PerhitunganJaminan')->latest();
    }

    public function sppb()
    {
        return $this->hasOne('App\Sppb')->latest();
    }

    public function definitif()
    {
        return $this->hasOne('App\DokumenDefinitif');
    }

    public function penomoran($codeNomor)
    {
        $tahun = date('Y');
        $adaNomor = Penomoran::where('tahun', $tahun)->where('kode', $codeNomor)->first();
        
        if ($adaNomor == null){
            $nomorBaru = new Penomoran;
            $nomorBaru->nomor = 1;
            $nomorBaru->kode = 'PENDAFTARAN RH';
            $nomorBaru->tahun = $tahun;
            $nomorBaru->save();
            $nomor = $nomorBaru->nomor;
        } else{
            $adaNomor->nomor = $adaNomor->nomor + 1;
            $adaNomor->save();
            $nomor = $adaNomor->nomor;
        }
        return $nomor;
    }

    //SET TO DATABASE

    public function setImportirNmAttribute($value)
    {
        $this->attributes['importir_nm'] = strtoupper($value);
    }

    public function setImportirAlamatAttribute($value)
    {
        $this->attributes['importir_alamat'] = strtoupper($value);
    }

    public function setPpjkNmAttribute($value)
    {
        $this->attributes['ppjk_nm'] = strtoupper($value);
    }

    public function setPpjkAlamatAttribute($value)
    {
        $this->attributes['ppjk_alamat'] = strtoupper($value);
    }

    public function setImportirNpwpAttribute($value)
    {
        $this->attributes['importir_npwp'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setPpjkNpwpAttribute($value)
    {
        $this->attributes['ppjk_npwp'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setTibaTglAttribute($value)
    {
        $this->attributes['tiba_tgl'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setMawbTglAttribute($value)
    {
        $this->attributes['mawb_tgl'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setHawbTglAttribute($value)
    {
        $this->attributes['hawb_tgl'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setBc11TglAttribute($value)
    {
        $this->attributes['bc11_tgl'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setJaminanTglAttribute($value)
    {
        $this->attributes['jaminan_tgl'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setTglFasilitasAttribute($value)
    {
        $this->attributes['tgl_fasilitas'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

     //GET FROM DATABASE
    public function getDaftarTglAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getTibaTglAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getMawbTglAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getHawbTglAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getBc11TglAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getJaminanTglAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getTglFasilitasAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getDaftarNoAttribute($value)
    {
        $value = str_pad($value, 5, '0', STR_PAD_LEFT);
        return $value;
    }

    public function getBc11NoAttribute($value)
    {
        if (!$value) {
            return $value = '';
        }
        $value = str_pad($value, 5, '0', STR_PAD_LEFT);
        return $value;
    }

    public function getBc11PosAttribute($value)
    {
        if (!$value) {
            return $value = '';
        }
        $value = str_pad($value, 5, '0', STR_PAD_LEFT);
        return $value;
    }

    public function getBc11SubAttribute($value)
    {
        if (!$value) {
            return $value = '';
        }
        $value = str_pad($value, 5, '0', STR_PAD_LEFT);
        return $value;
    }
}
