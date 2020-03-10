<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    protected $table = 'dokumen_ip';

    public function dokumen()
    {
        return $this->belongsTo('App\Dokumen', 'dokumen_id');
    }

    // public function getCreatedAtAttribute($value)
    // {
    //     $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
    //     return $value;
    // }

    
    public function getNoIpAttribute($value)
    {
        $value = str_pad($value, 5, '0', STR_PAD_LEFT);
        return $value;
    }
}
