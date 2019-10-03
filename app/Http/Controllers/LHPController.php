<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Lhp;
use App\Ip;
use App\LhpBarang;
use App\LhpPhoto;
use App\User;
use App\Status;
use App\Lokasi;
use App\LogStatus;
Use App\Http\Requests\LhpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DataTables;

class LHPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }

        return view('lhp.index');
    }

    public function dataLhp(){
        if(Gate::denies('VIEW-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }


        if (auth()->user()->hasRole('PEMERIKSA')) {
            $lhp = DB::table('dokumen_lhp')
                    ->select(
                        'dokumen.id as id',
                        'dokumen.status_id',
                        'dokumen.daftar_no as nomor',
                        'dokumen.daftar_tgl as tgl',
                        'dokumen.importir_nm as importir',
                        'dokumen.hawb_no as awb',
                        'dokumen_lhp.no_lhp as no_lhp',
                        'dokumen_lhp.created_at as lhp_tgl',
                        'dokumen_lhp.pemeriksa_nama as pemeriksa',
                        'dokumen.updated_at'
                        )
                    ->join('dokumen', 'dokumen_lhp.dokumen_id', '=','dokumen.id')
                    ->where('dokumen_lhp.pemeriksa_id', auth()->user()->id)
                    ->get();
        }
        
        if (auth()->user()->hasRole('ADMIN')) {
            $lhp = DB::table('dokumen_lhp')
                    ->select(
                        'dokumen.id as id',
                        'dokumen.status_id',
                        'dokumen.daftar_no as nomor',
                        'dokumen.daftar_tgl as tgl',
                        'dokumen.importir_nm as importir',
                        'dokumen.hawb_no as awb',
                        'dokumen_lhp.no_lhp as no_lhp',
                        'dokumen_lhp.created_at as lhp_tgl',
                        'dokumen_lhp.pemeriksa_nama as pemeriksa',
                        'dokumen.updated_at'
                        )
                    ->join('dokumen', 'dokumen_lhp.dokumen_id', '=','dokumen.id')
                    ->get();
        }



            return Datatables::of($lhp)
                ->editColumn('tgl', function($lhp){
                    return date('d-m-Y', strtotime($lhp->tgl));
                })
                ->editColumn('lhp_tgl', function($lhp){
                    return date('d-m-Y', strtotime($lhp->lhp_tgl));
                })
                ->addColumn('action', function ($lhp) {

                    $btn = '<a href="'.route('lhp.show', $lhp->id).'" class="btn btn-xs btn-success">Lihat</a> 
                        <a href="'.route('cetak.lhp', $lhp->id).'" class="btn btn-xs btn-primary" target="_blank">Cetak</a>
                        <a href="'.route('cetak.ba', $lhp->id).'" class="btn btn-xs btn-primary" target="_blank">Cetak BA</a> 
                    ';
                    
                    //jika status rekam LHP muncul tombol rekam
                    if($lhp->status_id <= 4){
                        $btn = $btn . '<a href="'. route('lhp.edit', $lhp->id).'" class="btn btn-xs btn-danger">Edit</a>';

                    }

                    return $btn;
                })
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(Gate::denies('CREATE-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = Dokumen::findOrFail($id);
        $lokasi = Lokasi::all();

        return view('lhp.create', compact('dokumen', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if(Gate::denies('CREATE-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }
        // dd($request->all());

        $this->validate($request,[
            'tgl_periksa' => 'required',
            'lokasi' => 'required',
            'kesimpulan' => 'required',
        ]);
        try{
            DB::beginTransaction();
            $status = Status::findOrFail(4);
            $dokumen = Dokumen::findOrFail($id);
            $codePenomoran = 'NOMOR_LHP';

            $lhp = new Lhp;
            $lhp->dokumen_id = $dokumen->id;
            $lhp->no_lhp = $dokumen->penomoran($codePenomoran);
            $lhp->tgl_periksa = $request->tgl_periksa;
            $lhp->jam_periksa = $request->jam_periksa;
            $lhp->jam_selesai = $request->jam_selesai;
            $lhp->lokasi = $request->lokasi;
            $lhp->jumlah_partai_barang = $request->jumlah_partai_barang;
            $lhp->no_kemasan = $request->no_kemasan;
            $lhp->kondisi_segel = $request->kondisi_segel;
            $lhp->jumlah_jenis_barang_diperiksa = $request->jumlah_jenis_barang_diperiksa;
            $lhp->kesimpulan = $request->kesimpulan;
            $lhp->pemeriksa_id = auth()->user()->id;
            $lhp->pemeriksa_nip = auth()->user()->nip;
            $lhp->pemeriksa_nama = auth()->user()->name;
            $lhp->save();

            $dokumen->status_id = $status->id;
            $dokumen->status_label = $status->label;
            $dokumen->save();

            //urain barang lhp
            if ($request->uraian[0]== null) {
                return 'uraian tidak boleh kosong';
            }

            $c = count($request->uraian);

            for($i=0; $i < $c; $i++)
            {
                $lhp_barang = new LhpBarang;
                $lhp_barang->dokumen_id = $dokumen->id;
                $lhp_barang->dokumen_lhp_id = $lhp->id;
                $lhp_barang->jumlah_jenis_ukuran_kemasan = $request->jumlah_jenis_ukuran_kemasan[$i];
                $lhp_barang->uraian = $request->uraian[$i];
                $lhp_barang->jumlah_satuan = $request->jumlah_satuan[$i];
                $lhp_barang->spesifikasi = $request->spesifikasi[$i];
                $lhp_barang->negara_asal = $request->negara_asal[$i];
                $lhp_barang->keterangan = $request->keterangan[$i];
                $lhp_barang->user_id = auth()->user()->id;
                $lhp_barang->save();
            }

            if($request->hasFile('photos'))
            {
                foreach ($request->photos as $photo) {
                    $fileName = $photo->hashName();
                    $size = $photo->getClientSize();
                    $photo->storeAs('public\lhp_photos', $fileName);
                    LhpPhoto::create([
                        'dokumen_lhp_id' => $lhp->id,
                        'dokumen_id' => $dokumen->id,
                        'size' => $size,
                        'filename' => $fileName,
                        'user_id' => auth()->user()->id
                    ]);
                }
            }

            $StatusLog = new LogStatus;
            $StatusLog->dokumen_id= $dokumen->id;
            $StatusLog->status_id= $status->id;
            $StatusLog->status_label= $status->label;
            $StatusLog->user_id = auth()->user()->id;
            $StatusLog->user_name = auth()->user()->name;
            $StatusLog->save();
            
            DB::commit();
            Alert::success('Berhasil disimpan');

            return redirect()->route('lhp.show', $dokumen->id);
            
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
        if(Gate::denies('SHOW-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = Dokumen::findOrFail($id);
        $lhp = Lhp::where('dokumen_id', $id)->latest()->first();
        $photos = $lhp->photo;
        $barangLhps = $lhp->barangLhp;
        $no =1;
        return view('lhp.show', compact('dokumen','lhp', 'photos', 'barangLhps', 'no'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTab($id)
    {
        if(Gate::denies('SHOW-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }
        
        $dokumen = Dokumen::findOrFail($id);
        // dd($dokumen);
        $lhp = Lhp::where('dokumen_id', $id)->latest()->first();
        if(!$lhp){
            return back();
        }
        $photos = $lhp->photo;
        $barangLhps = $lhp->barangLhp;
        $no =1;
        return view('lhp.showTab', compact('dokumen','lhp', 'photos', 'barangLhps', 'no'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // //CEK ROLE
        if(Gate::denies('EDIT-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }

        // // CEK USER PEMERIKSA adalah pemilik dok

        $dokumen = Dokumen::findOrFail($id);

        if($dokumen->status_id >= 5 ){
            Alert::error('sudah SPPB');
            return back();
        }
        $lhp = Lhp::where('dokumen_id', $id)->latest()->first();

        if ($lhp->pemeriksa_id != auth()->user()->id) {           
            Alert::error('Bukan milik');
            return back();
        }

        $photos = $lhp->photo;
        $barangLhps = $lhp->barangLhp;
        $no =1;
        $lokasi = Lokasi::all();
        return view('lhp.edit', compact('dokumen','lhp', 'photos', 'barangLhps', 'no', 'lokasi'));
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
                // //CEK ROLE
        if(Gate::denies('EDIT-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }
        
        $this->validate($request,[
            'tgl_periksa' => 'required',
            'lokasi' => 'required',
            'kesimpulan' => 'required',
        ]);

        $lhp = lhp::findOrFail($id);

        //cek user
        $lhp->tgl_periksa = $request->tgl_periksa;
        $lhp->jam_periksa = $request->jam_periksa;
        $lhp->jam_selesai = $request->jam_selesai;
        $lhp->lokasi = $request->lokasi;
        $lhp->jumlah_partai_barang = $request->jumlah_partai_barang;
        $lhp->no_kemasan = $request->no_kemasan;
        $lhp->kondisi_segel = $request->kondisi_segel;
        $lhp->jumlah_jenis_barang_diperiksa = $request->jumlah_jenis_barang_diperiksa;
        $lhp->kesimpulan = $request->kesimpulan;
        $lhp->update();

        if($request->hasFile('photos'))
        {
            foreach ($request->photos as $photo) {
                $fileName = $photo->hashName();
                $size = $photo->getClientSize();
                $photo->storeAs('public\lhp_photos', $fileName);
                LhpPhoto::create([
                    'dokumen_lhp_id' => $lhp->id,
                    'dokumen_id' => $lhp->dokumen_id,
                    'size' => $size,
                    'filename' => $fileName,
                    'user_id' => auth()->user()->id
                ]);
            }
        }

        Alert::success('Berhasil disimpan');
        return back();
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

    public function detailBarangEdit($id){
        
        //CEK ROLE
        if(Gate::denies('EDIT-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }
            
        $barang = LhpBarang::findOrFail($id);
        // dd($barang);
        if ($barang->user_id != auth()->user()->id) {           
            Alert::error('Bukan milik');
            return back();
        }

        return view('lhp.detail-barang-edit', compact('barang'));

    }

    public function detailBarangUpdate(Request $request, $id){

        $this->validate($request,[
            'jumlah_jenis_ukuran_kemasan' => 'required',
            'uraian' => 'required',
            'jumlah_satuan' => 'required'
        ]);

        //cek user
        $barang = LhpBarang::findOrFail($id);

        $barang->jumlah_jenis_ukuran_kemasan = $request->jumlah_jenis_ukuran_kemasan;
        $barang->uraian = $request->uraian;
        $barang->jumlah_satuan = $request->jumlah_satuan;
        $barang->spesifikasi = $request->spesifikasi;
        $barang->negara_asal = $request->negara_asal;
        $barang->negara_asal = $request->negara_asal;
        $barang->keterangan = $request->keterangan;
        $barang->update();

        Alert::success('Berhasil disimpan');
        return back();

    }

    public function photoEdit($id){
        //CEK ROLE
        if(Gate::denies('EDIT-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }
        
        //cek user
        $photos = LhpPhoto::where('dokumen_lhp_id', $id)->get();

        return view('lhp.photo-edit', compact('photos'));

    }

    public function photoDestroy($id){
        // //CEK ROLE
        if(Gate::denies('EDIT-LHP'))
        {
            Alert::error('Sorry');
            return back();
        }

        $photo = LhpPhoto::findOrFail($id);

        if ($photo->user_id != auth()->user()->id) {           
            Alert::error('Bukan milik');
            return back();
        }

        

        //cek gambar tidak boleh kosong

        $exists = file_exists("storage/lhp_photos/". $photo->filename);

        if($exists){
            unlink("storage/lhp_photos/". $photo->filename);
        }
        
        $photo->delete();

        Alert::success('Berhasil dihapus');
        return back();
    }

    public function addPhoto(Request $request, $dok_id, $lhp_id, $id){

        
        if($request->hasFile('photos'))
        {
            foreach ($request->photos as $photo) {
                $fileName = $photo->hashName();
                $size = $photo->getClientSize();
                $photo->storeAs('public\lhp_photos', $fileName);
                LhpPhoto::create([
                    'dokumen_lhp_id' => $lhp_id,
                    'dokumen_id' => $dok_id,
                    'size' => $size,
                    'filename' => $fileName,
                    'user_id' => auth()->user()->id
                ]);
            }
            Alert::success('Berhasil ditambahkan');
            return redirect()->route('lhp.edit', $dok_id);

        } else {
            return back();
        }


    }
}
