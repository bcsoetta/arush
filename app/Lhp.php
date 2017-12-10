<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Lhp extends Model
{
    protected $table = 'dokumen_lhp';
    protected $fillable = ['hasil_pemeriksaan', 'dokumen_id', 'kesimpulan'];

    public function dokumen()
    {
        return $this->belongsTo('App\Dokumen', 'dokumen_id');
    }

    public function photo()
    {
        return $this->hasMany('App\LhpPhoto', 'dokumen_lhp_id');
    }

    public function barangLhp()
    {
        return $this->hasMany('App\LhpBarang', 'dokumen_lhp_id');
    }

    public function setTglPeriksaAttribute($value)
    {
        $this->attributes['tgl_periksa'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function getTglPeriksaAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }
    
    public function getCreatedAtAttribute($value)
    {
        $value = strlen($value)? Carbon::parse($value)->format('d-m-Y') : null;
        return $value;
    }

}
