<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class LiburNasional extends Model
{
    protected $table = 'libur_nasional';

    // public function setTglAttribute($value)
    // {
    //     $this->attributes['tgl'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    // }

    // public function getTglAttribute($value)
    // {
    //     $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
    //     return $value;
    // }
}
