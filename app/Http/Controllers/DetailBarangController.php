<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Kurs;
use App\DokumenDetail;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DetailBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Gate::denies('VIEW-DETAIL'))
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

        $no=1;
        return view('detailbarang.index', compact('dokumen', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dokumen $dokumen)
    {
        if(Gate::denies('CREATE-DETAIL'))
        {
            Alert::error('Sorry');
            return back();
        }

        if($dokumen->status_id > 1 AND auth()->user()->hasRole('PENGGUNA-JASA'))
        {
            Alert::error('Sorry');
            return back();
        }
        
        $kurs = Kurs::all();
        return view('detailbarang.create', compact('kurs', 'dokumen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('CREATE-DETAIL'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'dokumen_id' =>   'required',
            'uraian_barang' =>   'required',
            'kemasan_jumlah' =>   'required',
            'kemasan_jenis' =>   'required',
            'negara_asal' =>   'required',
            'hs_code' =>   'required',
            'harga_barang' =>   'required',
            'freight' =>   'required',
            'asuransi' =>   'required',
            'cif' =>   'required',
            'kurs_nilai' =>   'required',
            'kurs_label' =>   'required',
            'nilai_pabean' =>   'required',
            'trf_bm' =>   'required',
            'trf_ppn' =>   'required',
            'trf_ppnbm' =>   'required',
            'trf_pph' =>   'required',
            'bayar_bm' =>   'required',
            'bayar_ppn' =>   'required',
            'bayar_ppnbm' =>   'required',
            'bayar_pph' =>   'required',
            'bayar_total' =>   'required',
            'ditanggung_pmrnth_bm' =>   'required',
            'ditanggung_pmrnth_ppn' =>   'required',
            'ditanggung_pmrnth_ppnbm' =>   'required',
            'ditanggung_pmrnth_pph' =>   'required',
            'ditanggung_pmrnth_total' =>   'required',
            'ditangguhkan_bm' =>   'required',
            'ditangguhkan_ppn' =>   'required',
            'ditangguhkan_ppnbm' =>   'required',
            'ditangguhkan_pph' =>   'required',
            'ditangguhkan_total' =>   'required',
            'dibebaskan_bm' =>   'required',
            'dibebaskan_ppn' =>   'required',
            'dibebaskan_ppnbm' =>   'required',
            'dibebaskan_pph' =>   'required',
            'dibebaskan_pph' =>   'required',
            'dibebaskan_total' =>   'required',
        ]);

        $dokumen = Dokumen::findOrFail($request->dokumen_id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }

        $detail = new DokumenDetail;
        $detail->dokumen_id = $request->dokumen_id;
        $detail->uraian_barang = $request->uraian_barang;
        $detail->kemasan_jumlah = $request->kemasan_jumlah;
        $detail->kemasan_jenis = $request->kemasan_jenis;
        $detail->negara_asal = $request->negara_asal;
        $detail->hs_code = $request->hs_code;
        $detail->harga_barang = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->harga_barang));
        $detail->freight = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->freight));
        $detail->asuransi = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->asuransi));
        $detail->cif = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->cif));
        $detail->kurs_nilai = $request->kurs_nilai;
        $detail->kurs_label = $request->kurs_label;
        $detail->nilai_pabean = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->nilai_pabean));
        $detail->trf_bm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->trf_bm));
        $detail->trf_ppn = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->trf_ppn));
        $detail->trf_ppnbm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->trf_ppnbm));
        $detail->trf_pph = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->trf_pph));
        $detail->bayar_bm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->bayar_bm));
        $detail->bayar_ppn = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->bayar_ppn));
        $detail->bayar_ppnbm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->bayar_ppnbm));
        $detail->bayar_pph = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->bayar_pph));
        $detail->bayar_total = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->bayar_total));
        $detail->ditanggung_pmrnth_bm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditanggung_pmrnth_bm));
        $detail->ditanggung_pmrnth_ppn = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditanggung_pmrnth_ppn));
        $detail->ditanggung_pmrnth_ppnbm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditanggung_pmrnth_ppnbm));
        $detail->ditanggung_pmrnth_pph = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditanggung_pmrnth_pph));
        $detail->ditanggung_pmrnth_total = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditanggung_pmrnth_total));
        $detail->ditangguhkan_bm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditangguhkan_bm));
        $detail->ditangguhkan_ppn = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditangguhkan_ppn));
        $detail->ditangguhkan_ppnbm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditangguhkan_ppnbm));
        $detail->ditangguhkan_pph = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditangguhkan_pph));
        $detail->ditangguhkan_total = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->ditangguhkan_total));
        $detail->dibebaskan_bm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->dibebaskan_bm));
        $detail->dibebaskan_ppn = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->dibebaskan_ppn));
        $detail->dibebaskan_ppnbm = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->dibebaskan_ppnbm));
        $detail->dibebaskan_pph = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->dibebaskan_pph));
        $detail->dibebaskan_total = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->dibebaskan_total));

        $detail->save();
        
        return redirect()->route('dokumen.show', $detail->dokumen_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DokumenDetail  $detailDokumen
     * @return \Illuminate\Http\Response
     */
    public function show(DokumenDetail $dokumenDetail)
    {
        if(Gate::denies('SHOW-DETAIL'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = Dokumen::findOrFail($dokumenDetail->dokumen_id);
        $no =1;
        return view('detailbarang.show', compact('dokumenDetail', 'dokumen', 'no'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DokumenDetail  $detailDokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(DokumenDetail $dokumenDetail)
    {
        if(Gate::denies('EDIT-DETAIL'))
        {
            Alert::error('Sorry');
            return back();
        }

        $kurs = Kurs::all();
        return view('detailbarang.edit', compact('dokumenDetail', 'kurs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DokumenDetail  $detailDokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DokumenDetail $dokumenDetail)
    {
        if(Gate::denies('EDIT-DETAIL'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'dokumen_id' =>   'required',
            'uraian_barang' =>   'required',
            'kemasan_jumlah' =>   'required',
            'kemasan_jenis' =>   'required',
            'negara_asal' =>   'required',
            'hs_code' =>   'required',
            'harga_jenis' =>   'required',
            'harga_barang' =>   'required',
            'freight' =>   'required',
            'asuransi' =>   'required',
            'cif' =>   'required',
            'kurs_nilai' =>   'required',
            'kurs_label' =>   'required',
            'nilai_pabean' =>   'required',
            'trf_bm' =>   'required',
            'trf_ppn' =>   'required',
            'trf_ppnbm' =>   'required',
            'trf_pph' =>   'required',
            'bayar_bm' =>   'required',
            'bayar_ppn' =>   'required',
            'bayar_ppnbm' =>   'required',
            'bayar_pph' =>   'required',
            'bayar_total' =>   'required',
            'ditanggung_pmrnth_bm' =>   'required',
            'ditanggung_pmrnth_ppn' =>   'required',
            'ditanggung_pmrnth_ppnbm' =>   'required',
            'ditanggung_pmrnth_pph' =>   'required',
            'ditanggung_pmrnth_total' =>   'required',
            'ditangguhkan_bm' =>   'required',
            'ditangguhkan_ppn' =>   'required',
            'ditangguhkan_ppnbm' =>   'required',
            'ditangguhkan_pph' =>   'required',
            'ditangguhkan_total' =>   'required',
            'dibebaskan_bm' =>   'required',
            'dibebaskan_ppn' =>   'required',
            'dibebaskan_ppnbm' =>   'required',
            'dibebaskan_pph' =>   'required',
            'dibebaskan_pph' =>   'required',
            'dibebaskan_total' =>   'required',
        ]);

        $dokumen = Dokumen::findOrFail($request->dokumen_id);
        //cek user pengguna jasa
        if (auth()->user()->hasRole('PENGGUNA-JASA') AND $dokumen->user_id != auth()->user()->id) {           
            Alert::error('Sorry');
            return back();
        }

        // $dokumenDetail->dokumen_id = $request->dokumen_id;
        $dokumenDetail->uraian_barang = $request->uraian_barang;
        $dokumenDetail->kemasan_jumlah = $request->kemasan_jumlah;
        $dokumenDetail->kemasan_jenis = $request->kemasan_jenis;
        $dokumenDetail->negara_asal = $request->negara_asal;
        $dokumenDetail->hs_code = $request->hs_code;
        $dokumenDetail->harga_jenis = $request->harga_jenis;
        $dokumenDetail->harga_barang = (double)$request->harga_barang;
        $dokumenDetail->freight = (double)$request->freight;
        $dokumenDetail->asuransi = (double)$request->asuransi;
        $dokumenDetail->cif = (double)$request->cif;
        $dokumenDetail->kurs_nilai = $request->kurs_nilai;
        $dokumenDetail->kurs_label = $request->kurs_label;
        $dokumenDetail->nilai_pabean = (double)$request->nilai_pabean;
        $dokumenDetail->trf_bm = (double)$request->trf_bm;
        $dokumenDetail->trf_ppn = (double)$request->trf_ppn;
        $dokumenDetail->trf_ppnbm = (double)$request->trf_ppnbm;
        $dokumenDetail->trf_pph = (double)$request->trf_pph;
        $dokumenDetail->bayar_bm = (double)$request->bayar_bm;
        $dokumenDetail->bayar_ppn = (double)$request->bayar_ppn;
        $dokumenDetail->bayar_ppnbm = (double)$request->bayar_ppnbm;
        $dokumenDetail->bayar_pph = (double)$request->bayar_pph;
        $dokumenDetail->bayar_total = (double)$request->bayar_total;
        $dokumenDetail->ditanggung_pmrnth_bm = (double)$request->ditanggung_pmrnth_bm;
        $dokumenDetail->ditanggung_pmrnth_ppn = (double)$request->ditanggung_pmrnth_ppn;
        $dokumenDetail->ditanggung_pmrnth_ppnbm = (double)$request->ditanggung_pmrnth_ppnbm;
        $dokumenDetail->ditanggung_pmrnth_pph = (double)$request->ditanggung_pmrnth_pph;
        $dokumenDetail->ditanggung_pmrnth_total = (double)$request->ditanggung_pmrnth_total;
        $dokumenDetail->ditangguhkan_bm = (double)$request->ditangguhkan_bm;
        $dokumenDetail->ditangguhkan_ppn = (double)$request->ditangguhkan_ppn;
        $dokumenDetail->ditangguhkan_ppnbm = (double)$request->ditangguhkan_ppnbm;
        $dokumenDetail->ditangguhkan_pph = (double)$request->ditangguhkan_pph;
        $dokumenDetail->ditangguhkan_total = (double)$request->ditangguhkan_total;
        $dokumenDetail->dibebaskan_bm = (double)$request->dibebaskan_bm;
        $dokumenDetail->dibebaskan_ppn = (double)$request->dibebaskan_ppn;
        $dokumenDetail->dibebaskan_ppnbm = (double)$request->dibebaskan_ppnbm;
        $dokumenDetail->dibebaskan_pph = (double)$request->dibebaskan_pph;
        $dokumenDetail->dibebaskan_total = (double)$request->dibebaskan_total;

        $dokumenDetail->save();

        return redirect()->route('detail.show', $dokumenDetail->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DokumenDetail  $detailDokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(DokumenDetail $dokumenDetail)
    {
        if(Gate::denies('HAPUS-DETAIL'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumenDetail->delete();
        return back();
    }
}
