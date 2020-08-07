<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Penomoran;
use App\Pengangkut;
use App\Lokasi;
use App\Jaminan;
use App\Ip;
use App\Status;
use App\LogStatus;
use App\LiburNasional;
use App\Presensi;
use App\User;
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

    public function prosesDokumen(){
        if(Gate::denies('VIEW-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        if (request()->ajax())
        {
            $dokumen = DB::table('dokumen')
                    ->select(
                        'dokumen.id',
                        'dokumen.daftar_no',
                        'dokumen.daftar_tgl',
                        'dokumen.importir_nm',
                        'dokumen.ppjk_nm',
                        'dokumen.hawb_no',
                        'dokumen.hawb_tgl',
                        'dokumen.status_label',
                        'dokumen.status_id',
                        'dokumen_sppb.no_sppb',
                        'dokumen_sppb.created_at',
                        'dokumen_sppb.waktu_keluar',
                        'dokumen_definitif.nomor',
                        'dokumen_definitif.tanggal',
                        'dokumen_definitif.tgl_ntpn'
                    )
                    ->leftJoin('dokumen_sppb','dokumen.id','=','dokumen_sppb.dokumen_id')
                    ->leftJoin('dokumen_definitif','dokumen.id','=','dokumen_definitif.dokumen_id')
                    ->where('status_id','<', 7);

            return Datatables::of($dokumen)
            ->addColumn('action', function ($dokumen) {
                $urlDokumen= url('dokumen/'.$dokumen->id);
                return '<a href="'.$urlDokumen.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Detail</a>';
            })
            ->make(true);
        }

        return view('dokumen.proses');
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
                        'dokumen.ppjk_nm',
                        'dokumen.hawb_no',
                        'dokumen.hawb_tgl',
                        'dokumen.status_label',
                        'dokumen.status_id',
                        'dokumen_sppb.no_sppb',
                        'dokumen_sppb.created_at',
                        'dokumen_sppb.created_at',
                        'dokumen_sppb.waktu_keluar',
                        'dokumen_definitif.nomor',
                        'dokumen_definitif.tanggal',
                        'dokumen_definitif.tgl_ntpn'
                    )
                    ->leftJoin('dokumen_sppb','dokumen.id','=','dokumen_sppb.dokumen_id')
                    ->leftJoin('dokumen_definitif','dokumen.id','=','dokumen_definitif.dokumen_id');

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
            'pengangkut' => 'required',
            'tiba_tgl' => 'required|date',
            'hawb_no' => 'required|min:2',
            'hawb_tgl' => 'required|date',
            'kmsn_jmlh' => 'required|numeric|min:1',
            'kmsn_jenis' => 'required|min:2',
            'brutto' => 'required|numeric',
            'netto' => 'required|numeric',
            'jumlah_kemasan_partial' => 'numeric|nullable',
            'no_bc_11' => 'numeric|nullable',
            'pos_bc_11' => 'numeric|nullable',
            'sub_pos_bc_11' => 'numeric|nullable',
            'tgl_bc_11' => 'date|nullable',
            'lokasi' => 'required',
            'partial_manifes' => 'required',
            'lokasi_periksa_gudang_importir' => 'required',
            'setuju-trm' => 'required',
            'partial_ke' => 'numeric|nullable',
        ]);

        
        
        //Cek barang covid kah
        
        // Cek jika belum definitif untuk importir ini
        
        $importirBelumPib = Dokumen::whereIn('status_id', [5,6])
        ->Where(function($q) use($request){
            $q->where('importir_npwp', $request->importir_npwp)
            ->orWhere('ppjk_npwp', $request->ppjk_npwp);
        })
        ->get();
        
        $blokir=[];
        
        $importirBelumPib->map(function($doc){
            $tglAwal = $doc->sppb->created_at;
            $tglAwal = $tglAwal->toDateString();
            $today = date('Y-m-d');
            
            $selisih = hari_kerja($tglAwal, $today);
            
            $doc['selisih_hari'] = $selisih;
            return $doc;
            
        });
        
        foreach ($importirBelumPib as $dok) {
            if($dok->selisih_hari > 3){
                $blokir[]=1;
            }
        }
        
        $set = DB::table('setting')->where('blokir', 'Y')->find(1);
        
        // block them all
        if(count($blokir) > 0 AND isset($set->blokir)){
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
            $dokumen->hawb_no = preg_replace("/[\s\-_.]+/", "", $request->hawb_no);
            $dokumen->hawb_tgl = $request->hawb_tgl;
            $dokumen->kmsn_jmlh = $request->kmsn_jmlh;
            $dokumen->kmsn_jenis = $request->kmsn_jenis;
            $dokumen->bc11_partial = $request->partial_manifes;
            $dokumen->partial_ke = $request->partial_ke;
            $dokumen->kmsn_jmlh_partial = $request->jumlah_kemasan_partial;
            $dokumen->kmsn_jenis_partial = $request->jenis_kemasan_partial;
            
            $dokumen->brutto = $request->brutto;
            $dokumen->netto = $request->netto;
            $dokumen->bc11_no = $request->no_bc_11;
            $dokumen->bc11_tgl = $request->tgl_bc_11;
            $dokumen->bc11_pos = $request->pos_bc_11;
            $dokumen->bc11_sub = $request->sub_pos_bc_11;
            $dokumen->lokasi_id = $lokasi->id;
            $dokumen->lokasi_label = $lokasi->kode;
            $dokumen->lokasi_periksa_gd_importir = $request->lokasi_periksa_gudang_importir;
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

            // Alert::error($e->getMessage());
            // return back();

            return $e->getMessage();
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
            'pengangkut' => 'required',
            'tiba_tgl' => 'required|date',
            'hawb_no' => 'required|min:2',
            'hawb_tgl' => 'required|date',
            'kmsn_jmlh' => 'required|numeric|min:1',
            'kmsn_jenis' => 'required|min:2',
            'brutto' => 'required|numeric',
            'netto' => 'required|numeric',
            'jumlah_kemasan_partial' => 'numeric|nullable',
            'no_bc_11' => 'numeric|nullable',
            'pos_bc_11' => 'numeric|nullable',
            'sub_pos_bc_11' => 'numeric|nullable',
            'lokasi' => 'required',
            'partial_manifes' => 'required',
            'lokasi_periksa_gudang_importir' => 'required',
            'partial_ke' => 'numeric|nullable',
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

            $dokumen->ppjk_npwp = $request->ppjk_npwp;
            $dokumen->ppjk_nm = $request->ppjk_nm;
            $dokumen->ppjk_alamat = $request->ppjk_alamat;
            $dokumen->pengangkut_id = $pengangkut->id;
            $dokumen->pengangkut_kode = $pengangkut->kode;
            $dokumen->pengangkut_nama = $pengangkut->pesawat;
            $dokumen->tiba_tgl = $request->tiba_tgl;
            $dokumen->hawb_no = preg_replace("/[\s\-_.]+/", "", $request->hawb_no);
            $dokumen->hawb_tgl = $request->hawb_tgl;
            $dokumen->kmsn_jmlh = $request->kmsn_jmlh;
            $dokumen->kmsn_jenis = $request->kmsn_jenis;
            $dokumen->bc11_partial = $request->partial_manifes;
            $dokumen->partial_ke = $request->partial_ke;
            $dokumen->kmsn_jmlh_partial = $request->jumlah_kemasan_partial;
            $dokumen->kmsn_jenis_partial = $request->jenis_kemasan_partial;

            $dokumen->brutto = $request->brutto;
            $dokumen->netto = $request->netto;
            $dokumen->bc11_no = $request->no_bc_11;
            $dokumen->bc11_tgl = $request->tgl_bc_11;
            $dokumen->bc11_pos = $request->pos_bc_11;
            $dokumen->bc11_sub = $request->sub_pos_bc_11;
            $dokumen->lokasi_id = $lokasi->id;
            $dokumen->lokasi_label = $lokasi->kode;
            $dokumen->lokasi_periksa_gd_importir = $request->lokasi_periksa_gudang_importir;
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
            $dokumen = Dokumen::whereIn('status_id', [5,6])
            ->Where(function($q) use($request){
                $q->where('importir_npwp', $request->importir_npwp)
                  ->orWhere('ppjk_npwp', $request->ppjk_npwp);
            })
            ->get();

            $blokir=[];

            $dokumen->map(function($doc){
                $tglAwal = $doc->sppb->created_at;
                //untuk membuat jadi Y-m-d 00:00:00
                $tglAwal = $tglAwal->toDateString();
                $today = date('Y-m-d');

                $selisih = hari_kerja($tglAwal, $today);

                $doc['selisih_hari'] = $selisih;

                return $doc;

            });

        return view('dokumen/cek-dokumen', compact('dokumen'));
    }

    public function cekNpwp($npwp){
        // if(Gate::denies('CREATE-DOKUMEN'))
        // {
        //     Alert::error('Sorry');
        //     return back();
        // }

            //cek statusnya SPPb dan Keluar
            $dokumen= Dokumen::whereIn('status_id', [5,6])
            ->where('importir_npwp', $npwp)
            ->get();

            $dokumen->map(function($doc){
                $tglAwal = $doc->sppb->created_at;
                $tglAwal = $tglAwal->toDateString();
                $today = date('Y-m-d');

                $selisih = hari_kerja($tglAwal, $today);

                $doc['selisih_hari'] = $selisih;

                    return $doc;

            });
                      
            $blokir=[];

            foreach ($dokumen as $doc) {

                if($doc->selisih_hari > 3){
                    $blokir[] = 1;
                }
            }
            //setting pemblokiran ON or OFF
            $set = DB::table('setting')->where('blokir', 'Y')->find(1);
            // jika ada yang di blokir maka data dikirim
            if(count($blokir) > 0 AND isset($set->blokir)){
                return json_encode($dokumen);
            }
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

    public function penerimaanDokumenIP($id)
    {
        if(Gate::denies('PENERIMAAN-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        try{
            DB::beginTransaction();
            //random pemeriksa
            $pemeriksa = $this->randomPemeriksa();
            
            if(empty($pemeriksa)){
                Alert::error('Cek absensi saat ini');
                return back();
            }
            
            $dokumen = Dokumen::findOrFail($id);
            $status = Status::findOrFail('2');
            //cek staus dokumen 1
            if($dokumen->status_id != 1){
                Alert::error('error status');
                return back();
            }

            
            $codePenomoran = 'NOMOR_RH';
            //penomoran dokumen
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


            //kasih jeda 1 second
            sleep(1);
            //proses penunjukan IP System
            //cari pemeriksa available
            $dokumen = Dokumen::findOrFail($id);
            $status = Status::findOrFail(3);
            $codePenomoran = 'NOMOR_IP';
            $ip = new Ip;
            $ip->dokumen_id = $dokumen->id;
            $ip->no_ip = $dokumen->penomoran($codePenomoran);
            $ip->pemeriksa_id = $pemeriksa->id;
            $ip->pemeriksa_nip = $pemeriksa->nip;
            $ip->pemeriksa_nama = $pemeriksa->name;
            $ip->tingkat_periksa = '100%';
            $ip->aju_foto = 'YA';
            $ip->save();

            $dokumen->status_id = $status->id;
            $dokumen->status_label = $status->label;
            $dokumen->save();

            $StatusLog = new LogStatus;
            $StatusLog->dokumen_id= $dokumen->id;
            $StatusLog->status_id= $status->id;
            $StatusLog->status_label= $status->label;
            $StatusLog->user_name = 'SYSTEM';
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

    public function randomPemeriksa(){
        //cek ada pemeriksa yang availabel
        // perlu test jika pemeriksanya 1,2 dst
        $availabelPemeriksa = Presensi::where('end','>',now())->where('start','<', now())->get();
        $jumlahpemeriksa = $availabelPemeriksa->count();

        //cek kondisi jumlah pemeriksa
        if($jumlahpemeriksa > 1){
            //beri ruang 1 untuk pemeriksa
            $nl = $jumlahpemeriksa-1;
            //get latest ip limit by jumlah pemeriksa - minus one
            $ip = Ip::latest()->limit($nl)->get();

            do {
                //get random pemeriksa id
                //selama cek true loop until false
                $pemeriksa_id = $availabelPemeriksa->random()->user_id;
                $cek = $ip->contains('pemeriksa_id',$pemeriksa_id);
            } while ($cek);

        } elseif($jumlahpemeriksa == 1){
            $pemeriksa_id = $availabelPemeriksa->first()->user_id;
        } else {
            return;
        }
        
        return User::findOrFail($pemeriksa_id);
    }
}