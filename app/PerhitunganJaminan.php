<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class PerhitunganJaminan extends Model
{
    protected $table = 'dokumen_perhitungan_jaminan';

    public function dokumen()
    {
        return $this->belongsTo('App\Dokumen', 'dokumen_id');
    }

    public function getCreatedAtAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }
}
