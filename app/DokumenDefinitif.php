<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class DokumenDefinitif extends Model
{
    protected $table = 'dokumen_definitif';

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function getTanggalAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getCreatedAtAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y H:i:s') : null;
        return $value;
    }
}
