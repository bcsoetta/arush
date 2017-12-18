<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\DokumenDetail;
use App\Jaminan;
use App\JenisJaminan;
use App\PerhitunganJaminan;
use App\Setatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JaminanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }
        $jaminan = Jaminan::orderBy('updated_at', 'desc')->paginate(10);;
        $no = 1;
        return view('jaminan.index', compact('jaminan', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('CREATE-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }
        return view('jaminan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('CREATE-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'nomor' => 'required',
            'tanggal' => 'required',
            'penjamin' => 'required',
            'bentuk_jaminan' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required',
        ]);

        $jenis = JenisJaminan::findOrFail($request->jenis);

        $jaminan = new Jaminan;
        $jaminan->nomor = $request->nomor;
        $jaminan->tanggal = $request->tanggal;
        $jaminan->penjamin = $request->penjamin;
        $jaminan->bentuk_jaminan = $request->bentuk_jaminan;
        $jaminan->jumlah = $request->jumlah;
        $jaminan->jenis_id = $jenis->id;
        $jaminan->jenis_Label = $jenis->label;
        $jaminan->tanggal_jatuh_tempo = $request->tanggal_jatuh_tempo;
        $jaminan->save();

        Alert::success('Berhasil direkam');

        return redirect()->route('jaminan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $jaminan =  Jaminan::findOrFail($id);
        $dokumen =  Dokumen::where('jaminan_id', NULL)->has('perhitunganJaminan')->get();
        // $data = $jaminan->dokumen;
        // dd($data->last()->sppb);
        $no =1;

        return view('jaminan.show', compact('jaminan', 'dokumen', 'no'));
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

    public function perhitunganJaminan($id)
    {
        if(Gate::denies('PERHITUNGAN-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = Dokumen::findOrFail($id);

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

                    // dd($dokumen->perhitunganJaminan);

        return view('jaminan.perhitungan', compact('dokumen', 'perhitungan'));
    }

    public function perhitunganJaminanSimpan($id)
    {
        if(Gate::denies('PERHITUNGAN-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }

        try{
            DB::beginTransaction();
            $setatus = Setatus::findOrFail(5);
            $dokumen = Dokumen::findOrFail($id);

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

            if(!$dokumen->perhitunganJaminan){
                $perhitunganJaminan = new PerhitunganJaminan;
                $perhitunganJaminan->dokumen_id = $dokumen->id;
                $perhitunganJaminan->total = $perhitungan[0]->total;
                $perhitunganJaminan->seksi_id = auth()->user()->id;
                $perhitunganJaminan->seksi_nama = auth()->user()->name;
                $perhitunganJaminan->seksi_nip = auth()->user()->nip;
                $perhitunganJaminan->save();
            }elseif($dokumen->perhitunganJaminan->total != $perhitungan->first()->total){
                $data = PerhitunganJaminan::where('dokumen_id', $dokumen->id)->get();

                $perhitunganJaminan = PerhitunganJaminan::findOrFail($data->first()->id);
                $perhitunganJaminan->total = $perhitungan->first()->total;
                $perhitunganJaminan->save();
            }

            $dokumen->status_id = $setatus->id;
            $dokumen->status_label = $setatus->label;
            $dokumen->save();
            
            DB::commit();
            Alert::success('Berhasil Disimpan');
            return back();
            

         } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }
    }

    public function tambahDokumen(Request $request, $id)
    {
        if(Gate::denies('EDIT-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'dokumen' => 'required'
        ]);

        $setatus = Setatus::findOrFail(6);
        $jaminan = Jaminan::findOrFail($id);

        //jumlah jaminan tidak boleh lebih kecil dari nilai dokumen
        //termasuk yang terus menerus
        //cek jumlah jaminan
        //cek jumlah saldo dengan jaminan = PNJ
        //dokumen tidak boleh lebih besar dari jaminan
        // $perhitungan = PerhitunganJaminan::where('jaminan_id', $request->dokumen)->get();

        // dd($perhitungan);


        $dokumen = Dokumen::findOrFail($request->dokumen);
        $dokumen->jaminan_id = $jaminan->id;
        $dokumen->status_id = $setatus->id;
        $dokumen->status_label = $setatus->label;
        $dokumen->save();

        ALert::success('Berhasil ditambahkan');

        return back();
    }
}
