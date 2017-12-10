<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    protected $table = 'jaminan';

    public function dokumen()
    {
        return $this->hasMany('App\Dokumen', 'jaminan_id');
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function getTanggalAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function setTanggalJatuhTempoAttribute($value)
    {
        $this->attributes['tanggal_jatuh_tempo'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function getTanggalJatuhTempoAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }
}
