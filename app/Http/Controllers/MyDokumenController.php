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

class MyDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('my-dokumen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $dokumen = new Dokumen;
        $lokasi = Lokasi::all();
        $pengangkut = Pengangkut::all();
        return view('my-dokumen/create', compact('lokasi', 'pengangkut', 'dokumen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       


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
            if(empty($doc->sppb->created_at)){
                $doc['selisih_hari'] = 0;
                return $doc;
            }
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

        // // block them all
        if(count($blokir) > 0){
            //back to 
            return view('dokumen/belum-definitif', compact('importirBelumPib'));
        }

        // simpan ke DB
        try{
            DB::beginTransaction();

            $status = Status::findOrFail(0);
            $lokasi = Lokasi::findOrFail($request->lokasi);
            $pengangkut = Pengangkut::findOrFail($request->pengangkut);

            $dokumen = new Dokumen;
            // $dokumen->daftar_no = $nomor;
            // $dokumen->daftar_tgl = NULL;
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
            return redirect()->route('mydokumen.show', $dokumen->id);

        } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
                return view('my-dokumen.show', compact('dokumen', 'jaminan','importirBelumPib'));
            } else {
                $kurang_jaminan = 0;
                
                return view('my-dokumen.show', compact('dokumen', 'jaminan','importirBelumPib'));
            }
        }
        
        return view('my-dokumen.show', compact('dokumen', 'jaminan','importirBelumPib'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        //cek user pengguna jasa
        if ($dokumen->created_by != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }

        if ($dokumen->status_id > 2) {           
            Alert::error('Sorry');
            return back();
        }

        $lokasi = Lokasi::all();
        $pengangkut = Pengangkut::all();
        return view('my-dokumen.edit', compact('dokumen', 'lokasi', 'pengangkut'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $this->validate($request,[
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
            if ($dokumen->created_by != auth()->user()->id) {           
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
            return redirect()->route('mydokumen.show', $dokumen->id);

        } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataDokumen(){

        $dokumen = DB::table('dokumen')
                    ->select(
                        'dokumen.id',
                        'dokumen.daftar_no',
                        'dokumen.daftar_tgl',
                        'dokumen.importir_nm',
                        'dokumen.hawb_no',
                        'dokumen.hawb_tgl',
                        'dokumen.status_label',
                        'dokumen.status_id',
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
                    ->where('dokumen.created_by','=', auth()->user()->id)
                    ->get();

        return Datatables::of($dokumen)
        
        ->addColumn('action', function ($dokumen) {
            $urlDokumen= url('mydokumen/'.$dokumen->id);
            return '<a href="'.$urlDokumen.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Detail</a>';
        })
        ->make(true);
    }
}
