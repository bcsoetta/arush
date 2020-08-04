<?php

namespace App\Http\Controllers;

use App\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class PresensiController extends Controller
{
    public function create(){
        $hadir = Presensi::where('end','>=', Carbon::now())->where('user_id', auth()->user()->id)->get();
        return view('presensi.create', compact('hadir'));
    }

    public function store(Request $r){
        $this->validate($r,[
            'waktu_kerja' => 'required'
        ]);
        $start ='';
        $end ='';

        if($r->waktu_kerja === 'pagi'){
                $start = Carbon::createFromTime(07,30);
                $end = Carbon::createFromTime(17);
        } elseif ($r->waktu_kerja === 'sore') {
                $start = Carbon::createFromTime(17);
                $end = Carbon::createFromTime(23);
        } elseif ($r->waktu_kerja === 'malam'){
                $start = Carbon::createFromTime(23);
                $end = Carbon::createFromTime(07)->addDays(1);
        } else {
            return back()->withErrors('error!!');
        }
        

        //cek apakah masih punya absen yang berjalan
        // jika iya maka return back() sudah absen dengan waktu        
        $data = Presensi::where('end','>', Carbon::now())->where('user_id', auth()->user()->id)->first();
        // dd($data);
        if (!empty($data) && $data->count() > 0) {
            return back()->withErrors("Sudah hadir sampai :" . $data->end->format('d-m-Y H:i:s'));
        }

        $presensi = new Presensi;
        $presensi->user_id = auth()->user()->id;
        $presensi->check_in = now();
        $presensi->start = $start;
        $presensi->end = $end;
        $presensi->save();

        return back()->with('success', 'Berhasil di rekam');
    }
}
