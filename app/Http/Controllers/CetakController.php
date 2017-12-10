<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class CetakController extends Controller
{

    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }
        return view('cetak.show', compact('dokumen'));
    }
    public function cetakIp($id){

        $dokumen = Dokumen::findOrFail($id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }
        $pdf = PDF::loadView('cetak.ip',compact('dokumen'));
        return $pdf->stream('ip.pdf');
    }

    public function cetakLhp($id){

        $dokumen = Dokumen::findOrFail($id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }
        $no =1;
        $pdf = PDF::loadView('cetak.lhp',compact('dokumen', 'no'));
        return $pdf->stream('lhp.pdf');
    }

    public function cetakBa($id){

        $dokumen = Dokumen::findOrFail($id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }
        $pdf = PDF::loadView('cetak.ba',compact('dokumen'));
        return $pdf->stream('ba.pdf');
    }

    public function cetakPnj($id){
        $dokumen = Dokumen::findOrFail($id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }

        $perhitungan = DB::table('dokumen_detail')
                    ->select(
                        DB::raw('SUM(harga_barang) as harga'), 
                        DB::raw('SUM(freight) as freight'), 
                        DB::raw('SUM(asuransi) as asuransi'), 
                        DB::raw('SUM(cif) as cif'), 
                        DB::raw('SUM(nilai_pabean) as nilai_pabean'), 
                        DB::raw('SUM(bayar_bm) as bm'), 
                        DB::raw('SUM(bayar_ppn) as ppn'),
                        DB::raw('SUM(bayar_ppnbm) as ppnbm'),
                        DB::raw('SUM(bayar_pph) as pph'),
                        DB::raw('SUM(bayar_total) as total')
                    )
                    ->where('dokumen_id', $id)
                    ->get();

        $pdf = PDF::loadView('cetak.pnj',compact('dokumen', 'perhitungan'));

        return $pdf->stream('pnj.pdf');
    }

    public function sppb($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }
        
        $pdf = PDF::loadView('cetak.sppb',compact('dokumen'));
        return $pdf->stream('sppb.pdf');
    }
}
