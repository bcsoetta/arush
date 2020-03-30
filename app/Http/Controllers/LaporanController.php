<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\DokumenDetail;
use App\Penomoran;
use App\Pengangkut;
use App\Lokasi;
use App\Jaminan;
use App\Status;
use App\LogStatus;
use App\Sppb;
use App\LiburNasional;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function dokumen(){

        return view('laporan.dokumen');
    }

    public function jaminan(){
        //
    }

    public function harian(){

        return view('laporan.harian');

    }

    public function hariAntara(Request $request){
        $this->validate($request,[
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required'
        ]);

        
        $tgl_awal = \DateTime::createFromFormat('d-m-Y',$request->tgl_awal);
        $tgl_akhir = \DateTime::createFromFormat('d-m-Y',$request->tgl_akhir);

        $tgl_awal = $tgl_awal->format('Y-m-d');
        $tgl_akhir = $tgl_akhir->format('Y-m-d');

        if($tgl_awal == $tgl_akhir){


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
            ->where('jaminan.tanggal', $tgl_awal)
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
            ->where('jaminan.tanggal', $tgl_awal)
            ->first();

        } else{
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
            ->where('jaminan.tanggal','>=', $tgl_awal)
            ->where('jaminan.tanggal','<=', $tgl_akhir)
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
            ->where('jaminan.tanggal','>=', $tgl_awal)
            ->where('jaminan.tanggal','<=', $tgl_akhir)
            ->first();

        }

        return view('laporan.harian', compact('dokumen', 'dokumen_total'));

    }

    public function belumDefinitif(Request $request){

        //cek statusnya SPPb dan Keluar
        $dokumen= Dokumen::where('status_id', 5)
        ->orWhere('status_id', 6)
        ->orderBy('importir_nm')
        ->orderBy('importir_npwp')
        ->orderBy('daftar_tgl')
        ->get();

        // maipulasi collection
        $dokumen->map(function($doc){
            // tgl awal (tgl sppb, kenapa tgl sppb karena gate sudah otomatis)
            // mungkin suatu hari bisa hitung waktu gate out ini di ganti
            // dan rh seharusnya rush hanling jadi harusnya keluar cepat

            $tglAwal = $doc->sppb->created_at;
            $tglAwal = $tglAwal->toDateString();
            $today = date('Y-m-d');

            $selisih = hari_kerja($tglAwal, $today);

            //add new property 'selisih hari'
            $doc['selisih_hari'] = $selisih;
            return $doc;
        });

        return view('laporan.belum-definitif', compact('dokumen'));
    }

    public function belumGateOut(){
        //cek statusnya saja
        $dokumen= Dokumen::where('status_id', 5)
        ->get();

        return view('laporan.belum-gateout', compact('dokumen'));
    }

    public function terusMenerus(){
        $dokumen= [];
        return view('laporan.terus-menerus', compact('dokumen'));
    }
    
    //form laporan download
    public function formDownload(){
        return view('laporan.form-download');
    }

    //download dokumen
    public function downloadDokumen(Request $request){
        $this->validate($request,[
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required'
        ]);


        $tgl_awal = \DateTime::createFromFormat('d-m-Y',$request->tgl_awal);
        $tgl_akhir = \DateTime::createFromFormat('d-m-Y',$request->tgl_akhir);

        //karena formatnya d-m-Y 00:00:00
        //maka ditambah 1 hari supayan last 

        $tgl_awal = $tgl_awal->format('Y-m-d');
        $tgl_akhir = $tgl_akhir->format('Y-m-d 23:59:59');

        $dokumen = Dokumen::whereBetween('daftar_tgl',[$tgl_awal,$tgl_akhir]);


        $detail = DokumenDetail::whereHas('dokumen', function($query) use ($tgl_awal,$tgl_akhir){
            $query->whereBetween('daftar_tgl',[$tgl_awal,$tgl_akhir]);
        });

        $fileName = 'Dokumen RH Tgl '. $request->tgl_awal . ' sd ' . $request->tgl_akhir;

        Excel::create($fileName, function ($excel) use($dokumen, $detail, $fileName) {
            // Set the properties
            
            $excel->setTitle($fileName)->setCreator('Arush (Aplikasi Rush handling)');

            $excel->sheet('Dokumen', function($sheet) use ($dokumen) {
                $sheet->appendRow([
                    'NO RH',
                    'TGL',
                    'NPWP IMPORTIR',
                    'NAMA IMPORTIR',
                    'ALAMAT IMPORTIR',
                    'NPWP PPJK',
                    'NAMA PPJK',
                    'ALAMAT PPJK',
                    'KODE PANGANGKUT',
                    'NAMA PENGANGKUT',
                    'TGL TIBA',
                    'HAWB',
                    'TGL HAWB',
                    'JUMLAH KEMASAN',
                    'JENIS KEMASAN',
                    'BRUTTO',
                    'NETTO',
                    'LOKASI',
                    'PHT_BAYAR_BM',
                    'PHT_BAYAR_PPN',
                    'PHT_BAYAR_PPNBM',
                    'PHT_BAYAR_PPH',
                    'PHT_BAYAR_TOTAL',
                    'NO FASILITAS',
                    'TGL FASILITAS',
                    'KET FASILITAS',
                    'STATUS',
                    'KET PEMBATALAN',
                    'NO IP',
                    'TGL IP',
                    'NIP PEMERIKSA',
                    'NAMA PEMERIKSA',
                    'NIP SEKSI',
                    'NAMA SEKSI',
                    'NO LHP',
                    'TGL LHP',
                    'JAM MULAI PERIKSA',
                    'JAM SELESAI PERIKSA',
                    'LOKASI PERIKSA',
                    'NIP PEMERIKSA LHP',
                    'NAMA PEMERIKSA LHP',
                    'KESIMPULAN LHP',
                    'NO SPPB',
                    'TGL SPPB',
                    'NIP SEKSI SPPB',
                    'NAMA SEKSI SPPB',
                    'NIP PETUGAS GATE',
                    'NAMA PETUGAS GATE',
                    'CATATAN PENGELUARAN',
                    'WAKTU KELUAR GATE',
                    'JNS DOK DEFINITIF',
                    'NO DOK',
                    'TGL DOK',
                    'BILLING',
                    'NTPN',
                    'TGL NTPN',
                    'TOTAL BAYAR',
                    'PENDOK NAMA',
                    'PENDOK NIP'
                ]);

                $dokumen->chunk(500, function($dokumenInstance) use($sheet) {

                    foreach ($dokumenInstance as $val) {

                        $sheet->appendRow([
                            $val->daftar_no, 
                            $val->daftar_tgl, 
                            $val->importir_npwp, 
                            $val->importir_nm, 
                            $val->importir_alamat, 
                            $val->ppjk_npwp, 
                            $val->ppjk_nm, 
                            $val->ppjk_alamat, 
                            $val->pengangkut_kode, 
                            $val->pengangkut_nama, 
                            $val->tiba_tgl, 
                            $val->hawb_no, 
                            $val->hawb_tgl, 
                            $val->kmsn_jmlh, 
                            $val->kmsn_jenis, 
                            $val->brutto, 
                            $val->netto, 
                            $val->lokasi_label, 
                            $val->detail->sum('bayar_bm'), 
                            $val->detail->sum('bayar_ppn'), 
                            $val->detail->sum('bayar_ppnbm'), 
                            $val->detail->sum('bayar_pph'), 
                            $val->detail->sum('bayar_total'), 
                            $val->no_fasilitas, 
                            $val->tgl_fasilitas, 
                            $val->ket_fasilitas, 
                            $val->status_label, 
                            $val->keterangan_pembatalan, 
                            $val->ip['no_ip'], 
                            $val->ip['created_at'], 
                            $val->ip['pemeriksa_nip'], 
                            $val->ip['pemeriksa_nama'], 
                            $val->ip['seksi_nip'], 
                            $val->ip['seksi_nama'], 
                            $val->lhp['no_lhp'], 
                            $val->lhp['created_at'], 
                            $val->lhp['jam_periksa'], 
                            $val->lhp['jam_selesai'], 
                            $val->lhp['lokasi'], 
                            $val->lhp['pemeriksa_nip'], 
                            $val->lhp['pemeriksa_nama'], 
                            $val->lhp['kesimpulan'],
                            $val->sppb['no_sppb'], 
                            $val->sppb['created_at'], 
                            $val->sppb['seksi_nip'], 
                            $val->sppb['seksi_nama'], 
                            $val->sppb['gate_nip'], 
                            $val->sppb['gate_nama'], 
                            $val->sppb['catatan_pengeluaran'], 
                            $val->sppb['waktu_keluar'],
                            $val->definitif['jenis'],
                            $val->definitif['nomor'],
                            $val->definitif['tanggal'],
                            $val->definitif['billing'],
                            $val->definitif['ntpn'],
                            $val->definitif['tgl_ntpn'],
                            $val->definitif['total_bayar'],
                            $val->definitif['pendok_nama'],
                            $val->definitif['pendok_nip']
                        ]);
                    }
                });

            });

            $excel->sheet('Detail Barang Dokumen', function ($sheet) use ($detail) {
                $sheet->appendRow([
                    'NO RH',
                    'TGL',
                    'NAMA IMPORTIR',
                    'NPWP IMPORTIR',
                    'URAIAN BARANG',
                    'JUMLAH KMS',
                    'JENIS KMS',
                    'NEGARA ASAL',
                    'HS',
                    'JENIS HARGA',
                    'HARGA BARANG',
                    'FREIGHT',
                    'ASURANSI',
                    'CIF',
                    'NILAI KURS',
                    'JENIS KURS',
                    'NILAI PABEAN',
                    'TRF BM %',
                    'TRF PPN %',
                    'TRF PPNBM %',
                    'TRF PPH %',
                    'BAYAR BM',
                    'BAYAR PPN',
                    'BAYAR PPNBM',
                    'BAYAR PPH',
                    'BAYAR TOTAL',
                    'DITANGGUNG PMRNT BM',
                    'DITANGGUNG PMRNT PPN',
                    'DITANGGUNG PMRNT PPNBM',
                    'DITANGGUNG PMRNT PPH',
                    'DITANGGUNG PMRNT TOTAL',
                    'DITANGGUHKAN BM',
                    'DITANGGUHKAN PPN',
                    'DITANGGUHKAN PPNBM',
                    'DITANGGUHKAN PPH',
                    'DITANGGUHKAN TOTAL',
                    'DIBEBASKAN BM',
                    'DIBEBASKAN PPN',
                    'DIBEBASKAN PPNBM',
                    'DIBEBASKAN PPH',
                    'DIBEBASKAN TOTAL'
                ]);
                $detail->chunk(500, function($detailInstance) use($sheet) {
                    foreach ($detailInstance as $val) {
                        $sheet->appendRow([
                            $val->dokumen->daftar_no, 
                            $val->dokumen->daftar_tgl,
                            $val->dokumen->importir_nm,
                            $val->dokumen->importir_npwp,
                            $val->uraian_barang,
                            $val->kemasan_jumlah,
                            $val->kemasan_jenis,
                            $val->negara_asal,
                            $val->hs_code,
                            $val->harga_jenis,
                            $val->harga_barang,
                            $val->freight,
                            $val->asuransi,
                            $val->cif,
                            $val->kurs_nilai,
                            $val->kurs_label,
                            $val->nilai_pabean,
                            $val->trf_bm,
                            $val->trf_ppn,
                            $val->trf_ppnbm,
                            $val->trf_pph,
                            $val->bayar_bm,
                            $val->bayar_ppn,
                            $val->bayar_ppnbm,
                            $val->bayar_pph,
                            $val->bayar_total,
                            $val->ditanggung_pmrnth_bm,
                            $val->ditanggung_pmrnth_ppn,
                            $val->ditanggung_pmrnth_ppnbm,
                            $val->ditanggung_pmrnth_pph,
                            $val->ditanggung_pmrnth_total,
                            $val->ditangguhkan_bm,
                            $val->ditangguhkan_ppn,
                            $val->ditangguhkan_ppnbm,
                            $val->ditangguhkan_pph,
                            $val->ditangguhkan_total,
                            $val->dibebaskan_bm,
                            $val->dibebaskan_ppn,
                            $val->dibebaskan_ppnbm,
                            $val->dibebaskan_pph,
                            $val->dibebaskan_total
                        ]);
                    }

                });
             });

        })->export('xlsx');
    }

    //download detail barang
    public function downloadDetail(Request $request){

        $this->validate($request,[
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required'
        ]);


        $tgl_awal = \DateTime::createFromFormat('d-m-Y',$request->tgl_awal);
        $tgl_akhir = \DateTime::createFromFormat('d-m-Y',$request->tgl_akhir);

        //karena formatnya d-m-Y 00:00:00
        //maka ditambah 1 hari supayan last 

        $tgl_awal = $tgl_awal->format('Y-m-d');
        $tgl_akhir = $tgl_akhir->format('Y-m-d 23:59:59');

        // dd($tgl_akhir);


        // $dokumen = DokumenDetail::find(100);
        $detail = DokumenDetail::whereHas('dokumen', function($query) use ($tgl_awal,$tgl_akhir){
            $query->whereBetween('daftar_tgl',[$tgl_awal,$tgl_akhir]);
        })->get();


         Excel::create('Dokumen RH', function ($excel) use($detail) {
             // Set the properties
             $excel->setTitle('Dokumen Rush Handling')->setCreator('Arush (Aplikasi Rush handling)');
            
             $excel->sheet('Dokumen RH', function ($sheet) use ($detail) {
                 $row = 1;
                 $sheet->row($row, [
                     'NO',
                     'NO RH',
                     'TGL',
                     'NAMA IMPORTIR',
                     'NPWP IMPORTIR',
                     'URAIAN BARANG',
                     'JUMLAH KMS',
                     'JENIS KMS',
                     'NEGARA ASAL',
                     'HS',
                     'JENIS HARGA',
                     'HARGA BARANG',
                     'FREIGHT',
                     'ASURANSI',
                     'CIF',
                     'NILAI KURS',
                     'JENIS KURS',
                     'NILAI PABEAN',
                     'TRF BM %',
                     'TRF PPN %',
                     'TRF PPNBM %',
                     'TRF PPH %',
                     'BAYAR BM',
                     'BAYAR PPN',
                     'BAYAR PPNBM',
                     'BAYAR PPH',
                     'BAYAR TOTAL',
                     'DITANGGUNG PMRNT BM',
                     'DITANGGUNG PMRNT PPN',
                     'DITANGGUNG PMRNT PPNBM',
                     'DITANGGUNG PMRNT PPH',
                     'DITANGGUNG PMRNT TOTAL',
                     'DITANGGUHKAN BM',
                     'DITANGGUHKAN PPN',
                     'DITANGGUHKAN PPNBM',
                     'DITANGGUHKAN PPH',
                     'DITANGGUHKAN TOTAL',
                     'DIBEBASKAN BM',
                     'DIBEBASKAN PPN',
                     'DIBEBASKAN PPNBM',
                     'DIBEBASKAN PPH',
                     'DIBEBASKAN TOTAL'
                ]);
                 $no = 1;
                 foreach ($detail as $val) {
                    //  dd($val->detail->sum('bayar_bm'));
                     $sheet->row(++$row, [
                         $no++, 
                         $val->dokumen->daftar_no, 
                         $val->dokumen->daftar_tgl,
                         $val->dokumen->importir_nm,
                         $val->dokumen->importir_npwp,
                         $val->uraian_barang,
                         $val->kemasan_jumlah,
                         $val->kemasan_jenis,
                         $val->negara_asal,
                         $val->hs_code,
                         $val->harga_jenis,
                         $val->harga_barang,
                         $val->freight,
                         $val->asuransi,
                         $val->cif,
                         $val->kurs_nilai,
                         $val->kurs_label,
                         $val->nilai_pabean,
                         $val->trf_bm,
                         $val->trf_ppn,
                         $val->trf_ppnbm,
                         $val->trf_pph,
                         $val->bayar_bm,
                         $val->bayar_ppn,
                         $val->bayar_ppnbm,
                         $val->bayar_pph,
                         $val->bayar_total,
                         $val->ditanggung_pmrnth_bm,
                         $val->ditanggung_pmrnth_ppn,
                         $val->ditanggung_pmrnth_ppnbm,
                         $val->ditanggung_pmrnth_pph,
                         $val->ditanggung_pmrnth_total,
                         $val->ditangguhkan_bm,
                         $val->ditangguhkan_ppn,
                         $val->ditangguhkan_ppnbm,
                         $val->ditangguhkan_pph,
                         $val->ditangguhkan_total,
                         $val->dibebaskan_bm,
                         $val->dibebaskan_ppn,
                         $val->dibebaskan_ppnbm,
                         $val->dibebaskan_pph,
                         $val->dibebaskan_total
                    ]);
                 }
             });

         })->export('xlsx');
    }

    public function jaminanDokumen(){
        $dokumen = Dokumen::all();
        return view('laporan.dokumen-jaminan', compact('dokumen'));
    }
}
