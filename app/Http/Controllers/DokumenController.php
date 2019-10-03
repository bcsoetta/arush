<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Penomoran;
use App\Pengangkut;
use App\Lokasi;
use App\Jaminan;
use App\Status;
use App\LogStatus;
use App\LiburNasional;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DataTables;
use Illuminate\Validation\Rule;


class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }
     
        return view('dokumen.index');
    }


    public function dataDokumen(){
        if(Gate::denies('VIEW-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = DB::table('dokumen')
                    ->select(
                        'dokumen.id',
                        'dokumen.daftar_no',
                        'dokumen.daftar_tgl',
                        'dokumen.importir_nm',
                        'dokumen.hawb_no',
                        'dokumen.hawb_tgl',
                        'dokumen.status_label',
                        'dokumen_sppb.no_sppb',
                        'dokumen_sppb.created_at as tgl_sppb',
                        'dokumen_sppb.created_at as tgl_sppb',
                        'dokumen_sppb.waktu_keluar as waktu_keluar',
                        'dokumen_definitif.nomor as no_pib',
                        'dokumen_definitif.tanggal as tgl_pib',
                        'dokumen_definitif.tgl_ntpn as tgl_ntpn'
                    )
                    ->leftJoin('dokumen_sppb','dokumen.id','=','dokumen_sppb.dokumen_id')
                    ->leftJoin('dokumen_definitif','dokumen.id','=','dokumen_definitif.dokumen_id')
                    ->get();
        
        if (auth()->user()->hasRole('SEKSI')) {
            $dokumen = DB::table('dokumen')
                    ->select(
                        'dokumen.id',
                        'dokumen.daftar_no',
                        'dokumen.daftar_tgl',
                        'dokumen.importir_nm',
                        'dokumen.hawb_no',
                        'dokumen.hawb_tgl',
                        'dokumen.status_label',
                        'dokumen_sppb.no_sppb',
                        'dokumen_sppb.created_at as tgl_sppb',
                        'dokumen_sppb.created_at as tgl_sppb',
                        'dokumen_sppb.waktu_keluar as waktu_keluar',
                        'dokumen_definitif.nomor as no_pib',
                        'dokumen_definitif.tanggal as tgl_pib',
                        'dokumen_definitif.tgl_ntpn as tgl_ntpn'
                    )
                    ->leftJoin('dokumen_sppb','dokumen.id','=','dokumen_sppb.dokumen_id')
                    ->leftJoin('dokumen_definitif','dokumen.id','=','dokumen_definitif.dokumen_id')
                    ->where('status_id', 2)->orWhere('status_id', 4)
                    ->get();
        }

        if (auth()->user()->hasRole('ADMIN')) {
            // $dokumen = Dokumen::where('status_id', 2)->orWhere('status_id', 4);
            $dokumen = DB::table('dokumen')
                    ->select(
                        'dokumen.id',
                        'dokumen.daftar_no',
                        'dokumen.daftar_tgl',
                        'dokumen.importir_nm',
                        'dokumen.hawb_no',
                        'dokumen.hawb_tgl',
                        'dokumen.status_label',
                        'dokumen_sppb.no_sppb',
                        'dokumen_sppb.created_at as tgl_sppb',
                        'dokumen_sppb.created_at as tgl_sppb',
                        'dokumen_sppb.waktu_keluar as waktu_keluar',
                        'dokumen_definitif.nomor as no_pib',
                        'dokumen_definitif.tanggal as tgl_pib',
                        'dokumen_definitif.tgl_ntpn as tgl_ntpn'
                    )
                    ->leftJoin('dokumen_sppb','dokumen.id','=','dokumen_sppb.dokumen_id')
                    ->leftJoin('dokumen_definitif','dokumen.id','=','dokumen_definitif.dokumen_id')
                    ->get();
        }

        

        return Datatables::of($dokumen)
        
        ->addColumn('action', function ($dokumen) {
            $urlDokumen= url('dokumen/'.$dokumen->id);
            return '<a href="'.$urlDokumen.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Detail</a>';
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('CREATE-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = new Dokumen;
        $lokasi = Lokasi::all();
        $pengangkut = Pengangkut::all();
        return view('dokumen/create', compact('lokasi', 'pengangkut', 'dokumen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        if(Gate::denies('CREATE-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'importir_nm' =>   'required|min:3',
            'importir_npwp' => 'required',
            'importir_alamat' => 'required|min:6',
            // 'ppjk_nm' => 'required',
            // 'ppjk_npwp' => 'required',
            // 'ppjk_alamat' => 'required',
            'pengangkut' => 'required',
            'tiba_tgl' => 'required|date',
            'hawb_no' => 'required|unique:dokumen|min:2',
            'hawb_tgl' => 'required|date',
            // 'bc11_no' => 'required|numeric',
            // 'bc11_pos' => 'required|numeric',
            // 'bc11_sub' => 'required|numeric',
            // 'bc11_tgl' => 'required|date',
            'kmsn_jmlh' => 'required|numeric|min:1',
            'kmsn_jenis' => 'required|min:2',
            'brutto' => 'required|numeric',
            'netto' => 'required|numeric',
            'lokasi' => 'required'
        ]);

        // Cek jika belum definitif untuk importir ini

        $importirBelumPib = Dokumen::whereIn('status_id', [5,6])
        ->where('importir_npwp', $request->importir_npwp)
        ->orWhere('ppjk_npwp', $request->ppjk_npwp)
        ->get();

        $blokir=[];

        $importirBelumPib->map(function($doc){
            $tglAwal = $doc->sppb->created_at;
            $tglAwal = implode("-", array_reverse(explode("-", $tglAwal)));
            $today = date('Y-m-d');

            $selisih = $this->hariKerja($tglAwal, $today);

            $doc['selisih_hari'] = $selisih;
            return $doc;

        });

        foreach ($importirBelumPib as $dok) {
            if($dok->selisih_hari > 3){
                $blokir[]=1;
            }
        }

        // // block them all
        if(count($blokir) > 0){
            //back to 
            return view('dokumen/belum-definitif', compact('importirBelumPib'));
        }

        // simpan ke DB
        try{
            DB::beginTransaction();

            $status = Status::findOrFail('1');
            $lokasi = Lokasi::findOrFail($request->lokasi);
            $pengangkut = Pengangkut::findOrFail($request->pengangkut);

            $dokumen = new Dokumen;
            // $dokumen->daftar_no = $nomor;
            $dokumen->daftar_tgl = date('Y-m-d H:i:s');
            $dokumen->importir_nm = $request->importir_nm;
            $dokumen->importir_npwp = $request->importir_npwp;
            $dokumen->importir_alamat = $request->importir_alamat;
            $dokumen->ppjk_npwp = $request->ppjk_npwp;
            $dokumen->ppjk_nm = $request->ppjk_nm;
            $dokumen->ppjk_alamat = $request->ppjk_alamat;
            $dokumen->pengangkut_id = $pengangkut->id;
            $dokumen->pengangkut_kode = $pengangkut->kode;
            $dokumen->pengangkut_nama = $pengangkut->pesawat;
            $dokumen->tiba_tgl = $request->tiba_tgl;
            $dokumen->hawb_no = preg_replace("/[\s-_.]+/", "", $request->hawb_no);
            $dokumen->hawb_tgl = $request->hawb_tgl;
            $dokumen->kmsn_jmlh = $request->kmsn_jmlh;
            $dokumen->kmsn_jenis = $request->kmsn_jenis;
            $dokumen->brutto = $request->brutto;
            $dokumen->netto = $request->netto;
            $dokumen->lokasi_id = $lokasi->id;
            $dokumen->lokasi_label = $lokasi->kode;
            $dokumen->no_fasilitas = $request->no_fasilitas;
            $dokumen->tgl_fasilitas = $request->tgl_fasilitas;
            $dokumen->ket_fasilitas = $request->ket_fasilitas;
            if (auth()->user()->hasRole('PENGGUNA-JASA')) {           
                $dokumen->ppjk_user_id = auth()->user()->id;
            }

            $dokumen->created_by = auth()->user()->id;
            $dokumen->status_id = $status->id;
            $dokumen->status_label = $status->label;
            $dokumen->save();

            $StatusLog = new LogStatus;
            $StatusLog->status_id= $status->id;
            $StatusLog->dokumen_id= $dokumen->id;
            $StatusLog->status_label= $status->label;
            $StatusLog->user_id = auth()->user()->id;
            $StatusLog->user_name = auth()->user()->name;
            $StatusLog->save();

            DB::commit();
            Alert::success('Berhasil Disimpan');
            return redirect()->route('dokumen.show', $dokumen->id);

        } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('SHOW-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        
        //cek user pengguna jasa
        // if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
        //     Alert::error('Sorry');
        //     return back();
        // }

        $dokumen = Dokumen::findOrFail($id);

        $jaminan = Jaminan::where('jenis_id', 2)->where('status', 'AKTIF')->get();
        
        // cari dokumen yang belum definitif dari importir ini
        $importirBelumPib = DB::table('dokumen')
        ->select('*')
        ->where('importir_npwp', $dokumen->importir_npwp)
        ->where('status_id', [5,6])
        ->get(); 


        $kurang_jaminan = 0;

        if(count($dokumen->detail) > 0){
            //total bayar
            $bayar_total  = $dokumen->detail->sum('bayar_total');
            //total jaminan
            $total_jaminan = $dokumen->jaminan->sum('jumlah');

            if($bayar_total > $total_jaminan){
                $kurang_jaminan = $total_jaminan - $bayar_total;
                
                // Alert::error('Kekurangan Jaminan ' . $kurang_jaminan);
                return view('dokumen.show', compact('dokumen', 'jaminan','importirBelumPib'));
            } else {
                $kurang_jaminan = 0;
                
                return view('dokumen.show', compact('dokumen', 'jaminan','importirBelumPib'));
            }
        }
        
        return view('dokumen.show', compact('dokumen', 'jaminan','importirBelumPib'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('EDIT-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }


        $dokumen = Dokumen::findOrFail($id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }

        if ($dokumen->status_id > 4) {           
            Alert::error('Sorry');
            return back();
        }

        $lokasi = Lokasi::all();
        $pengangkut = Pengangkut::all();
        return view('dokumen.edit', compact('dokumen', 'lokasi', 'pengangkut'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies('EDIT-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }
        $dokumen = Dokumen::findOrFail($id);

        $this->validate($request,[
            // 'importir_nm' =>   'required|min:3',
            // 'importir_npwp' => 'required',
            // 'importir_alamat' => 'required|min:6',
            // 'ppjk_nm' => 'required',
            // 'ppjk_npwp' => 'required',
            // 'ppjk_alamat' => 'required',
            'pengangkut' => 'required',
            'tiba_tgl' => 'required|date',
            'hawb_no' => [
                'required',
                'min:2,',
                Rule::unique('dokumen')->ignore($dokumen->id)

            ],
            'hawb_tgl' => 'required|date',
            'kmsn_jmlh' => 'required|numeric|min:1',
            'kmsn_jenis' => 'required|min:2',
            'brutto' => 'required|numeric',
            'netto' => 'required|numeric',
            'lokasi' => 'required'
        ]);

        try{
            DB::beginTransaction();

            $lokasi = Lokasi::findOrFail($request->lokasi);
            $pengangkut = Pengangkut::findOrFail($request->pengangkut);

            $dokumen = Dokumen::findOrFail($id);
            //cek user pengguna jasa
            if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
                Alert::error('Sorry');
                return back();
            }
            // $dokumen->importir_nm = $request->importir_nm;
            // $dokumen->importir_npwp = $request->importir_npwp;
            // $dokumen->importir_alamat = $request->importir_alamat;
            $dokumen->ppjk_npwp = $request->ppjk_npwp;
            $dokumen->ppjk_nm = $request->ppjk_nm;
            $dokumen->ppjk_alamat = $request->ppjk_alamat;
            $dokumen->pengangkut_id = $pengangkut->id;
            $dokumen->pengangkut_kode = $pengangkut->kode;
            $dokumen->pengangkut_nama = $pengangkut->pesawat;
            $dokumen->tiba_tgl = $request->tiba_tgl;
            $dokumen->hawb_no = preg_replace("/[\s-_.]+/", "", $request->hawb_no);
            $dokumen->hawb_tgl = $request->hawb_tgl;
            $dokumen->kmsn_jmlh = $request->kmsn_jmlh;
            $dokumen->kmsn_jenis = $request->kmsn_jenis;
            $dokumen->brutto = $request->brutto;
            $dokumen->netto = $request->netto;
            $dokumen->lokasi_id = $lokasi->id;
            $dokumen->lokasi_label = $lokasi->kode;
            $dokumen->no_fasilitas = $request->no_fasilitas;
            $dokumen->tgl_fasilitas = $request->tgl_fasilitas;
            $dokumen->ket_fasilitas = $request->ket_fasilitas;
            $dokumen->save();

            DB::commit();

            Alert::success('Berhasil Update');
            return redirect()->route('dokumen.show', $dokumen->id);

        } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumen $dokuman)
    {
        if(Gate::denies('HAPUS-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokuman->detail()->delete();
        $dokuman->delete();
        return back();
    }

    public function penomoranDokumen($id)
    {
        if(Gate::denies('PENERIMAAN-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        try{
            DB::beginTransaction();

            $status = Status::findOrFail('2');
            $dokumen = Dokumen::findOrFail($id);
            $codePenomoran = 'NOMOR_RH';

            if($dokumen->status_id != 1){
                Alert::error('error status');
                return back();
            }

            $dokumen->daftar_no = $dokumen->penomoran($codePenomoran);
            $dokumen->status_id = $status->id;
            $dokumen->status_label = $status->label;
            $dokumen->save();

            $StatusLog = new LogStatus;
            $StatusLog->status_id= $status->id;
            $StatusLog->dokumen_id= $dokumen->id;
            $StatusLog->status_label= $status->label;
            $StatusLog->user_id = auth()->user()->id;
            $StatusLog->user_name = auth()->user()->name;
            $StatusLog->save();
            
            DB::commit();
            
            Alert::success('Penerimaan Berhasil');
            return back();            

         } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }


    }

    public function jaminan($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if(count($dokumen->jaminan) == 0)
        {
            Alert::error('Belum Rekam jaminan');
            return back();
        }

        $jamin = $dokumen->jaminan;

        return view('dokumen.jaminan', compact('jamin', 'dokumen'));
    }


    public function cekDokumen(){
        if(Gate::denies('CREATE-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        return view('dokumen/cek-dokumen');
    }

    public function prosesCekDokumen(Request $request){
        if(Gate::denies('CREATE-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }
            $importirBelumPib = Dokumen::whereIn('status_id', [5,6])
            ->where('importir_npwp', $request->importir_npwp)
            ->orWhere('ppjk_npwp', $request->ppjk_npwp)
            ->get();

            $blokir=[];

            foreach ($importirBelumPib as $doc) {
                $date1 = date_create(date('Y-m-d', strtotime($doc->sppb->created_at)));
                $date2 = date_create(date('Y-m-d'));
                $diff1 = date_diff($date1,$date2);
                $diff2 = (int) $diff1->format("%a");
                
                if($diff2 > 3){
                    $blokir[] = 1;
                }

            }
            
        return view('dokumen/cek-dokumen', compact('importirBelumPib'));
    }

    public function cekNpwp($npwp){
        if(Gate::denies('CREATE-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

            //cek statusnya SPPb dan Keluar
            $dokumen= Dokumen::whereIn('status_id', [5,6])
            ->where('importir_npwp', $npwp)
            ->get();

            $dokumen->map(function($doc){
                $tglAwal = $doc->sppb->created_at;
                $tglAwal = implode("-", array_reverse(explode("-", $tglAwal)));
                $today = date('Y-m-d');

                $selisih = $this->hariKerja($tglAwal, $today);

                $doc['selisih_hari'] = $selisih;

                    return $doc;

            });

            // dd($dokumen);
            
            $blokir=[];

            foreach ($dokumen as $doc) {

                if($doc->selisih_hari > 3){
                    $blokir[] = 1;
                }
            }

            if(count($blokir) > 0){
                return json_encode($dokumen);
            }
    }

    //fungsi menerima tanggal string format Y-m-d
    //return integer
    function hariKerja($tglAwal, $tglAkhir){
        // penanggalan Indonesia
        setlocale(LC_TIME, 'id_ID.UTF8');
        // tanggalnya diubah formatnya ke Y-m-d 
        $tglAwal = date_create_from_format('Y-m-d', $tglAwal);
        $tglAwal = date_format($tglAwal, 'Y-m-d');
        $tglAwal = strtotime($tglAwal);
        
        $tglAkhir = date_create_from_format('Y-m-d', $tglAkhir);
        $tglAkhir = date_format($tglAkhir, 'Y-m-d');
        $tglAkhir = strtotime($tglAkhir);

        $hariKerja = array();
        $sabtuminggu = array();
        
        for ($i=$tglAwal; $i <= $tglAkhir; $i += (60 * 60 * 24)) {
            if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                $hariKerja[] = $i;
            } else {
                $sabtuminggu[] = $i;
            }
        
        }

        //tgl libur Nasional string Y-m-d
        $tglLiburNasional = LiburNasional::select('tgl')->get();


        $liburNasional=array();
        $liburNasionalSabtuMinggu=array();

        foreach ($tglLiburNasional as $tglLibur) {
            $tglLibur = date_create_from_format('Y-m-d', $tglLibur->tgl);
            $tglLibur = date_format($tglLibur, 'Y-m-d');
            $tglLibur = strtotime($tglLibur);
            //Cek apakah tgl lebih kecil atau lebih besar dari tgl awal atau akhir
            if($tglLibur <= $tglAkhir and $tglLibur >= $tglAwal ){
                //CEK APAKAH HARI MINGGU ATAU TIDAK
                if (date('w', $tglLibur) !== '0' && date('w', $tglLibur) !== '6') {
                    $liburNasional[] = $tglLibur;
                } else {
                    $liburNasionalSabtuMinggu[] = $tglLibur;
                }
            }
            
        }

        $jlhHariKerja = count($hariKerja) - count($liburNasional)-1;
        // $jumlah_sabtuminggu = count($sabtuminggu);
        // $abtotal = $jumlah_cuti + $jumlah_sabtuminggu;

        return $jlhHariKerja;

    }

    public function pembatalan(Request $request, $id){
        
        if(Gate::denies('HAPUS-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'keterangan_pembatalan' =>  'required|min:3'
        ]);

        $status = Status::findOrFail('8');
        $dokumen = Dokumen::findOrFail($id);

        foreach ($dokumen->jaminan as $jamin) {
            if($jamin->jenis_id == 1 AND $jamin->status == 'AKTIF'){
                Alert::error('Jaminan masih aktif');
                return back();
            }
        }



        
        if($dokumen->status_id >= 5){
            Alert::error('Status SPPB');
            return back();
        }
        
        
        //deatach jaminan tidak perlu karena status 8
        // if(count($dokumen->jaminan) > 0){
            //     //cari jaminan yang terus menerus
            //     $dokumen->jaminan()->detach();
            // }
        if($dokumen->daftar_no == NULL or $dokumen->daftar_no == '00000'){

            if(count($dokumen->detail) > 0){
                $dokumen->detail()->delete();
            }

            if(count($dokumen->dokumenPelengkap) > 0){
                $dokumen->dokumenPelengkap()->delete();
            }

            $dokumen->delete();

            Alert::success('Berhasil Dibatalkan');
            return redirect()->route('dokumen.index');
        }
        

        $dokumen->status_id = $status->id;
        $dokumen->status_label = $status->label;
        $dokumen->keterangan_pembatalan = $request->keterangan_pembatalan;
        $dokumen->update();
        
        // //delete detail barang
        // if(count($dokumen->detail) > 0){
        //     $dokumen->detail()->delete();
        // }
        
        $StatusLog = new LogStatus;
        $StatusLog->status_id= $status->id;
        $StatusLog->dokumen_id= $dokumen->id;
        $StatusLog->status_label= $status->label;
        $StatusLog->user_id = auth()->user()->id;
        $StatusLog->user_name = auth()->user()->name;
        $StatusLog->save();

        Alert::success('Berhasil Dibatalkan');
        return back();   
    }
       
}