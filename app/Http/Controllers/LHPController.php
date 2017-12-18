<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Lhp;
use App\Ip;
use App\LhpBarang;
use App\LhpPhoto;
use App\User;
use App\Setatus;
Use App\Http\Requests\LhpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class LHPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lhp = LHP::where('pemeriksa_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(10);
        $no = 1;
        return view('lhp.index', compact('lhp', 'no'));
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
        // $pemeriksa = User::all('id','name', 'nip');
        return view('lhp.create', compact('dokumen', 'pemeriksa'));
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

        $this->validate($request,[
            'tgl_periksa' => 'required',
            'lokasi' => 'required',
            'kesimpulan' => 'required',
        ]);
        try{
            DB::beginTransaction();
            $setatus = Setatus::findOrFail(4);
            $dokumen = Dokumen::findOrFail($id);

            $lhp = new Lhp;
            $lhp->dokumen_id = $dokumen->id;
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

            $dokumen->status_id = $setatus->id;
            $dokumen->status_label = $setatus->label;
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
                $lhp_barang->save();
            }

            if($request->hasFile('photos'))
            {
                foreach ($request->photos as $photo) {
                    $fileName = 'dok'. '_'.$dokumen->id. '_' . 'lhp'. '_'. $lhp->id . '_' . $photo->hashName();
                    $size = $photo->getClientSize();
                    $photo->storeAs('public\lhp_photos', $fileName);
                    LhpPhoto::create([
                        'dokumen_lhp_id' => $lhp->id,
                        'dokumen_id' => $dokumen->id,
                        'size' => $size,
                        'filename' => $fileName
                    ]);
                }
            }
            
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
        $lhp = Lhp::where('dokumen_id', $id)->latest()->first();
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
        //
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
        //
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
}
