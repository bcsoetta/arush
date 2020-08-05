<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WaktuKerja extends Model
{
    protected $table = 'waktu_kerja';

    public function todayMulai(){
        return Carbon::now()->setTimeFromTimeString($this->waktu_mulai);
    }
    public function todaySelesai(){
        return Carbon::now()->setTimeFromTimeString($this->waktu_selesai);
    }
}
