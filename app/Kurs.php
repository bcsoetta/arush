<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Kurs extends Model
{
    protected $table = 'kurs';
    protected $fillable = ['nilai', 'tgl_awal', 'tgl_akhir'];

    public function setTglAwalAttribute($value)
    {
        $this->attributes['tgl_awal'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setTglAkhirAttribute($value)
    {
        $this->attributes['tgl_akhir'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function getTglAwalAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getTglAkhirAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }
}
