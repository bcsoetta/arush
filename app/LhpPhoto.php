<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LhpPhoto extends Model
{
    protected $table = 'dokumen_lhp_photo';
    protected $fillable = ['dokumen_lhp_id', 'dokumen_id', 'filename', 'size', 'user_id'];

    public function lhp()
    {
        return $this->belongsTo('App\Lhp');
    }
}
