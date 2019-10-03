<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class DokumenPelengkap extends Model
{
    protected $table = 'dokumen_pelengkap';

    public function setTglAttribute($value)
    {
        $this->attributes['tgl'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function getTglAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }
}
