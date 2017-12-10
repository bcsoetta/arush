<?php
namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Sppb extends Model
{
    protected $table = 'dokumen_sppb';

    public function getCreatedAtAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

    public function getWaktuKeluarAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y H:i:s') : null;
        return $value;
    }
}
