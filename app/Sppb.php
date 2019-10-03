<?php
namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Sppb extends Model
{
    protected $table = 'dokumen_sppb';

    public function getCreatedAtAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : NULL;
        return $value;
    }

    public function getWaktuKeluarAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y H:i:s') : NULL;
        return $value;
    }

    
    public function getnoSppbAttribute($value)
    {
        $value = str_pad($value, 5, '0', STR_PAD_LEFT);
        return $value;
    }
}
