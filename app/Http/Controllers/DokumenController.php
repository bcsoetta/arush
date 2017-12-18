<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Penomoran;
use App\Pengangkut;
use App\Lokasi;
use App\Jaminan;
use App\Setatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
     
        if (auth()->user()->hasRole('PENGGUNA-JASA')) {
            $dokumen = Dokumen::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(10);
        } elseif(auth()->user()->hasRole('STAF')){
            $dokumen = Dokumen::orderBy('updated_at', 'desc')->paginate(10);
        } elseif(auth()->user()->hasRole('SEKSI')){
            // $dokumen = Dokumen::where('status_id', 2)->orWhere('status_id', 4)->orWhere('status_id', 6)->get()->sortByDesc("updated_at");
            $dokumen = Dokumen::where('status_id', 2)->orWhere('status_id', 4)->orWhere('status_id', 6)->orderBy('updated_at', 'desc')->paginate(10);
        } elseif(auth()->user()->hasRole('PFPD')){
            $dokumen = Dokumen::where('status_id', 9)->orderBy('updated_at', 'desc')->paginate(10);
        } else {
            Alert::error('Sorry');
            return back();
        }

        return view('dokumen.index', compact('dokumen'));
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
            'mawb_no' => 'required|min:2',
            'mawb_tgl' => 'required|date',
            'hawb_no' => 'required|min:2',
            'hawb_tgl' => 'required|date',
            'bc11_no' => 'required|numeric',
            'bc11_pos' => 'required|numeric',
            'bc11_sub' => 'required|numeric',
            'bc11_tgl' => 'required|date',
            'kmsn_jmlh' => 'required|numeric|min:1',
            'kmsn_jenis' => 'required|min:2',
            'brutto' => 'required|numeric',
            'netto' => 'required|numeric',
            'lokasi' => 'required'
        ]);

        try{
            DB::beginTransaction();

            $setatus = Setatus::findOrFail('1');
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
            $dokumen->mawb_no = $request->mawb_no;
            $dokumen->mawb_tgl = $request->mawb_tgl;
            $dokumen->hawb_no = $request->hawb_no;
            $dokumen->hawb_tgl = $request->hawb_tgl;
            $dokumen->bc11_no = $request->bc11_no;
            $dokumen->bc11_pos = $request->bc11_pos;
            $dokumen->bc11_sub = $request->bc11_sub;
            $dokumen->bc11_tgl = $request->bc11_tgl;
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
                $dokumen->user_id = auth()->user()->id;
            }
            $dokumen->status_id = $setatus->id;
            $dokumen->status_label = $setatus->label;
            $dokumen->save();

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

        $dokumen = Dokumen::findOrFail($id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }
        return view('dokumen.show', compact('dokumen'));
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

        $this->validate($request,[
            'importir_nm' =>   'required|min:3',
            'importir_npwp' => 'required',
            'importir_alamat' => 'required|min:6',
            // 'ppjk_nm' => 'required',
            // 'ppjk_npwp' => 'required',
            // 'ppjk_alamat' => 'required',
            'pengangkut' => 'required',
            'tiba_tgl' => 'required|date',
            'mawb_no' => 'required|min:2',
            'mawb_tgl' => 'required|date',
            'hawb_no' => 'required|min:2',
            'hawb_tgl' => 'required|date',
            'bc11_no' => 'required|numeric',
            'bc11_pos' => 'required|numeric',
            'bc11_sub' => 'required|numeric',
            'bc11_tgl' => 'required|date',
            'kmsn_jmlh' => 'required|numeric|min:1',
            'kmsn_jenis' => 'required|min:3',
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
            $dokumen->mawb_no = $request->mawb_no;
            $dokumen->mawb_tgl = $request->mawb_tgl;
            $dokumen->hawb_no = $request->hawb_no;
            $dokumen->hawb_tgl = $request->hawb_tgl;
            $dokumen->bc11_no = $request->bc11_no;
            $dokumen->bc11_pos = $request->bc11_pos;
            $dokumen->bc11_sub = $request->bc11_sub;
            $dokumen->bc11_tgl = $request->bc11_tgl;
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

    public function terimaDokumen($id)
    {
        if(Gate::denies('PENERIMAAN-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        try{
            DB::beginTransaction();

            $setatus = Setatus::findOrFail('2');
            $dokumen = Dokumen::findOrFail($id);

            if($dokumen->status_id != 1){
                Alert::error('error setatus');
                return back();
            }

            $dokumen->daftar_no = $dokumen->penomoran('PENDAFTARAN RH');
            $dokumen->status_id = $setatus->id;
            $dokumen->status_label = $setatus->label;
            $dokumen->save();
            
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
        if(!$dokumen->jaminan_id)
        {
            Alert::error('Rekam jaminan');
            return back();
        }
        $jaminan = Jaminan::findOrFail($dokumen->jaminan_id);

        return view('dokumen.jaminan', compact('jaminan', 'dokumen'));
    }

    // public function importir(Request $request){
    //     $term = $request->term;//jquery
    //     // $data= Profile::where('nama', 'like', '%'.$term.'%')->get();
    //     $data= DB::table('view_importir_dokumen')->where('importir_nm', 'like', '%'.$term.'%')->get();
    //     dd($data); 
    //     $result=array();
    //     foreach ($data as $query)
    //     {
    //         $results[] = [ 'id' => $query->importir_id, 'value' => $query->importir_nm ];
    //     }
    //     return Response()->json($results);
    // }
    
}
