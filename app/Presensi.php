<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $dates = ['check_in', 'start','end', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}