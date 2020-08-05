<?php

namespace App\Http\Controllers;

use App\Presensi;
use App\WaktuKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class PresensiController extends Controller
{

    public function index(){
        $hadir = Presensi::orderBy('end', 'desc')->paginate(5);

        return view('presensi.index', compact('hadir'));
    }
    public function create(){
        $waktuKerja = WaktuKerja::get();
        $hadir = Presensi::where('end','>=', Carbon::now())->where('user_id', auth()->user()->id)->get();
        return view('presensi.create', compact('hadir','waktuKerja'));
    }

    public function store(Request $r){
        $this->validate($r,[
            'waktu_kerja' => 'required'
        ]);

        $waktukerja = WaktuKerja::where('label', $r->waktu_kerja)->firstOrFail();

        //cek apakah masih punya absen yang berjalan
        // jika iya maka return back() sudah absen dengan waktu        
        $data = Presensi::where('end','>', Carbon::now())->where('user_id', auth()->user()->id)->first();
        if (!empty($data) && $data->count() > 0) {
            return back()->withErrors("Sudah hadir sampai :" . $data->end->format('d-m-Y H:i:s'));
        }

        $presensi = new Presensi;
        $presensi->user_id = auth()->user()->id;
        $presensi->label = $waktukerja->label;
        $presensi->check_in = now();
        $presensi->start = $waktukerja->todayMulai();
        $presensi->end =$waktukerja->todaySelesai();
        $presensi->save();

        return back()->with('success', 'Berhasil di rekam');
    }
}
