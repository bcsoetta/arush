<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Jaminan;
use App\User;
use App\BeritaAcara;
use App\Penomoran;
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
        // dd($dokumen->ip);
        // cek user pengguna jasa
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

    public function bpj($jaminan_id, $dokumen_id){
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }
        //id dari jaminan
        $jaminan = Jaminan::findOrFail($jaminan_id);
        $dokumen = Dokumen::findOrFail($dokumen_id);


        $pdf = PDF::loadView('cetak.bpj',compact('jaminan', 'dokumen'));
        return $pdf->stream('bpj.pdf');
    }

    public function formCetakJaminanHarian(){
        $users = User::where('active', 1)->get();
        $ba = BeritaAcara::all();

        return view('cetak.form-cetak-jaminan-harian', compact('users', 'ba'));
    }

    public function storeJaminanHarian(Request $request){

        $this->validate($request,[
            'tgl_lapor' => 'required',
            'pelapor' => 'required',
            'jabatan' => 'required',
            'unit' => 'required',
            'tgl_jaminan_awal' => 'required',
            'tgl_jaminan_akhir' => 'required'
        ]);
        
        $user = User::findOrFail($request->pelapor);
        
        $ba = new BeritaAcara;
        
        $codePenomoran = 'BA_J_RH';

        $ba->nomor = $ba->penomoran($codePenomoran);
        $ba->tgl_pelaporan = $request->tgl_lapor;
        $ba->user_id = $user->id;
        $ba->name = $user->name;
        $ba->nip = $user->nip;
        $ba->jabatan = $request->jabatan;
        $ba->unit = $request->unit;
        $ba->tgl_jaminan_awal = $request->tgl_jaminan_awal;
        $ba->tgl_jaminan_akhir = $request->tgl_jaminan_akhir;
        $ba->save();

       return back();

    }

    public function cetakBaJaminan($id){
        $ba = BeritaAcara::findOrFail($id);

        $dokumen_total = DB::table('dokumen_jaminan')
            ->select(
                'dokumen.daftar_no', 
                'dokumen.daftar_tgl', 
                'jaminan.penjamin', 
                DB::raw('SUM(dokumen_detail.bayar_bm) as bm'), 
                DB::raw('SUM(dokumen_detail.bayar_ppn) as ppn'), 
                DB::raw('SUM(dokumen_detail.bayar_ppnbm) as ppnbm'), 
                DB::raw('SUM(dokumen_detail.bayar_pph) as pph'), 
                DB::raw('SUM(dokumen_detail.bayar_total) as total'), 
                'jaminan.nomor', 
                'jaminan.tanggal', 
                DB::raw('SUM(jaminan.jumlah) as jumlah'))
            ->join('dokumen', 'dokumen.id', '=', 'dokumen_jaminan.dokumen_id')
            ->join('jaminan', 'jaminan.id', '=', 'dokumen_jaminan.jaminan_id')
            ->join('dokumen_detail', 'dokumen_detail.dokumen_id', '=', 'dokumen.id')
            ->where('jaminan.jenis_id', 1)
            ->where('jaminan.status', 'AKTIF')
            ->where('jaminan.tanggal', $ba->tgl_jaminan_awal)
            ->where('jaminan.tanggal','<=', $ba->tgl_jaminan_akhir)
            ->first();
      
        $pdf = PDF::loadView('cetak.ba-jaminan-harian',compact('ba', 'dokumen_total'));
        
        return $pdf->stream('ba-jaminan-harian.pdf');
    }

    public function cetakLampiranba($id){
        $ba = BeritaAcara::findOrFail($id);

        $dokumen = DB::table('dokumen_jaminan')
            ->select(
                'dokumen.daftar_no', 
                'dokumen.daftar_tgl', 
                'jaminan.penjamin', 
                DB::raw('SUM(dokumen_detail.bayar_bm) as bm'), 
                DB::raw('SUM(dokumen_detail.bayar_ppn) as ppn'), 
                DB::raw('SUM(dokumen_detail.bayar_ppnbm) as ppnbm'), 
                DB::raw('SUM(dokumen_detail.bayar_pph) as pph'), 
                DB::raw('SUM(dokumen_detail.bayar_total) as total'), 
                'jaminan.nomor', 
                'jaminan.tanggal', 
                DB::raw('SUM(jaminan.jumlah) as jumlah'))
            ->join('dokumen', 'dokumen.id', '=', 'dokumen_jaminan.dokumen_id')
            ->join('jaminan', 'jaminan.id', '=', 'dokumen_jaminan.jaminan_id')
            ->join('dokumen_detail', 'dokumen_detail.dokumen_id', '=', 'dokumen.id')
            ->where('jaminan.jenis_id', 1)
            ->where('jaminan.status', 'AKTIF')
            ->where('jaminan.tanggal','>=', $ba->tgl_jaminan_awal)
            ->where('jaminan.tanggal','<=', $ba->tgl_jaminan_akhir)
            ->groupBy('dokumen.id')
            ->get();

        $dokumen_total = DB::table('dokumen_jaminan')
            ->select(
                'dokumen.daftar_no', 
                'dokumen.daftar_tgl', 
                'jaminan.penjamin', 
                DB::raw('SUM(dokumen_detail.bayar_bm) as bm'), 
                DB::raw('SUM(dokumen_detail.bayar_ppn) as ppn'), 
                DB::raw('SUM(dokumen_detail.bayar_ppnbm) as ppnbm'), 
                DB::raw('SUM(dokumen_detail.bayar_pph) as pph'), 
                DB::raw('SUM(dokumen_detail.bayar_total) as total'), 
                'jaminan.nomor', 
                'jaminan.tanggal', 
                DB::raw('SUM(jaminan.jumlah) as jumlah'))
            ->join('dokumen', 'dokumen.id', '=', 'dokumen_jaminan.dokumen_id')
            ->join('jaminan', 'jaminan.id', '=', 'dokumen_jaminan.jaminan_id')
            ->join('dokumen_detail', 'dokumen_detail.dokumen_id', '=', 'dokumen.id')
            ->where('jaminan.jenis_id', 1)
            ->where('jaminan.tanggal','>=', $ba->tgl_jaminan_awal)
            ->where('jaminan.tanggal','<=', $ba->tgl_jaminan_akhir)
            ->first();

      
        // $pdf = PDF::loadView('cetak.lampiran-ba-jaminan-harian',compact('ba', 'dokumen', 'dokumen_total'))->setPaper('a4', 'landscape');
        
        // return $pdf->stream('lampiran-ba-jaminan-harian.pdf');

        return view('cetak.lampiran-ba-jaminan-harian',compact('ba', 'dokumen', 'dokumen_total'));
    }
}
