<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\DokumenDetail;
use App\Jaminan;
use App\JenisJaminan;
use App\PerhitunganJaminan;
use App\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DataTables;

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
        // $jaminan = Jaminan::orderBy('updated_at', 'desc')->paginate(10);
        return view('jaminan.index');
    }

    public function dataJaminan(){
        if(Gate::denies('VIEW-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

            $jaminan = DB::table('jaminan');

            return Datatables::of($jaminan)
            ->addColumn('saldo', function($jaminan){
                $dibayarkan = DB::table('dokumen_jaminan')
                ->select(DB::raw('SUM(dokumen_detail.bayar_total) as total'))
                ->join('dokumen', 'dokumen.id', '=', 'dokumen_jaminan.dokumen_id')
                ->join('jaminan', 'jaminan.id', '=', 'dokumen_jaminan.jaminan_id')
                ->join('dokumen_detail', 'dokumen_detail.dokumen_id', '=', 'dokumen.id')
                ->where('jaminan.id', $jaminan->id)
                ->where('dokumen.status_id', '<', 7)
                ->first();

                $saldo = $jaminan->jumlah - $dibayarkan->total;

                return $saldo;
            })
            ->addColumn('action', function ($jaminan) {

                $urlJaminanDetail= url('jaminan/show/'.$jaminan->id);
                $urlJaminanEdit= url('jaminan/edit/'.$jaminan->id);

                return '<a href="'.$urlJaminanDetail.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-folder-open"></i>Detail</a> 
                <a href="'.$urlJaminanEdit.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Edit</a>';
            })
            ->make(true);
    }

    public function dataJaminanShow($dokumen_id){
        if(Gate::denies('VIEW-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $jaminan = Jaminan::where('jenis_id', 2)->get();

        return Datatables::of($jaminan)
        ->addColumn('saldo', function($jaminan){
            $dibayarkan = DB::table('dokumen_jaminan')
            ->select(DB::raw('SUM(dokumen_detail.bayar_total) as total'))
            ->join('dokumen', 'dokumen.id', '=', 'dokumen_jaminan.dokumen_id')
            ->join('jaminan', 'jaminan.id', '=', 'dokumen_jaminan.jaminan_id')
            ->join('dokumen_detail', 'dokumen_detail.dokumen_id', '=', 'dokumen.id')
            ->where('jaminan.id', $jaminan->id)
            ->where('dokumen.status_id', '<', 7)
            ->first();

            $saldo = $jaminan->jumlah - $dibayarkan->total;

            return $saldo;
        })
        ->addColumn('action', function ($jaminan) use ($dokumen_id) {
            $urlAttachJaminanToDokumen= url('/jaminan/attachjaminantodokumen/'.$jaminan->id.'/'.$dokumen_id);
            return '<a class="btn btn-xs btn-primary" href="'.$urlAttachJaminanToDokumen.'" onclick="return confirm(\'Gunakan jaminan ?\');">Gunakan Jaminan</a>';
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
            'penjamin' => 'required',
            'bentuk_jaminan' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required',
            ]);
        
        $dokumen = Dokumen::findOrFail($request->dok_id);
        
        // cek nomor RH jaminan
        if($dokumen->daftar_no == '00000' or $dokumen->daftar_no == NULL ){
            Alert::error('Belum memiliki nomor RH');
            return back();
        }
        
        $codePenomoran = 'NOMOR_BPJ';
        
        //cek total pembayaran dokumen
        $total_bayar = $dokumen->detail->sum('bayar_total');

        
        //cek total jaminan
        $jumlahJaminan = (double)preg_replace('/[,]/','.',preg_replace('/[^,\d]/', '',$request->jumlah));
        
        //cek kesesuaina
        $selisih = $jumlahJaminan - $total_bayar;

        $jenis = JenisJaminan::findOrFail($request->jenis);
        //buat jaminan 
        $jaminan = new Jaminan;
        $jaminan->nomor = $dokumen->penomoran($codePenomoran);
        
        //karena ada setter dimodel jadi formatnya seperti ini
        $jaminan->tanggal = date("d-m-Y");
        
        $jaminan->penjamin = $request->penjamin;
        $jaminan->npwp = $request->npwp;
        $jaminan->alamat = $request->alamat;
        $jaminan->nomor_jaminan = $request->nomor_jaminan;
        $jaminan->tanggal_jaminan = $request->tanggal_jaminan;
        $jaminan->bentuk_jaminan = $request->bentuk_jaminan;
        $jaminan->jumlah = $jumlahJaminan;
        $jaminan->jenis_id = $jenis->id;
        $jaminan->jenis_Label = $jenis->label;
        $jaminan->tanggal_jatuh_tempo = $request->tanggal_jatuh_tempo;
        $jaminan->user_id = auth()->user()->id;
        $jaminan->save();

        $dokumen->jaminan()->attach($jaminan->id);

            // JIka ada selisih kasih tahu ada selisih
            if ($selisih < 0) {
                Alert::error('Berhasil direkam dengan kekurangan ' . number_format($selisih,0,',','.'));
                return back();
            }
        
        // berasisl direkam tanpa selisih
        Alert::success('Berhasil direkam');
        return back();

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
        $no = 1;

        $dibayarkan = DB::table('dokumen_jaminan')
        ->select(DB::raw('SUM(dokumen_detail.bayar_total) as total'))
        ->join('dokumen', 'dokumen.id', '=', 'dokumen_jaminan.dokumen_id')
        ->join('jaminan', 'jaminan.id', '=', 'dokumen_jaminan.jaminan_id')
        ->join('dokumen_detail', 'dokumen_detail.dokumen_id', '=', 'dokumen.id')
        ->where('jaminan.id', $jaminan->id)
        ->where('dokumen.status_id', '<', 7)
        ->first();

        $saldo = $jaminan->jumlah - $dibayarkan->total;

        $jaminan->saldo = $saldo;

        return view('jaminan.show', compact('jaminan', 'no'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('EDIT-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $jaminan = Jaminan::findOrFail($id);
        // dd($jaminan);
        return view('jaminan.edit', compact('jaminan'));
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

        // dd($request->all());
        if(Gate::denies('CREATE-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'penjamin' => 'required',
            'npwp' => 'required',
            'bentuk_jaminan' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required',
            'status' => 'required'
        ]);

        $jenis = JenisJaminan::findOrFail($request->jenis);

        $jaminan = Jaminan::findOrFail($id);
        $jaminan->penjamin = $request->penjamin;
        $jaminan->npwp = $request->npwp;
        $jaminan->alamat = $request->alamat;
        $jaminan->nomor_jaminan = $request->nomor_jaminan;
        $jaminan->tanggal_jaminan = $request->tanggal_jaminan;
        $jaminan->bentuk_jaminan = $request->bentuk_jaminan;
        $jaminan->jumlah = $request->jumlah;
        $jaminan->jenis_id = $jenis->id;
        $jaminan->jenis_label = $jenis->label;
        $jaminan->no_bukti_pengembalian = $request->no_bukti_pengembalian;
        $jaminan->tgl_bukti_pengembalian = $request->tgl_bukti_pengembalian;
        $jaminan->kode_agenda = $request->kode_agenda;
        $jaminan->status = $request->status;

        $jaminan->save();

        Alert::success('Berhasil Disimpan');
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
                    if($perhitungan->first()->total == NULL)
                    {
                        Alert::error('Tidak ada Detail Barang');
                        return back();
                    }

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
            $status = Status::findOrFail(5);
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

            $dokumen->status_id = $status->id;
            $dokumen->status_label = $status->label;
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

        $status = Status::findOrFail(6);
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
        $dokumen->status_id = $status->id;
        $dokumen->status_label = $status->label;
        $dokumen->save();

        Alert::success('Berhasil ditambahkan');

        return back();
    }

    public function attachJaminanToDokumen($jaminan_id,$dokumen_id){

        $jaminan = Jaminan::findOrFail($jaminan_id);

        $dokumen = Dokumen::findOrFail($dokumen_id);

        // cek sudah ada detail barang
        if(count($dokumen->detail) == 0){
            Alert::error('Belum memiliki detail barang');
            return back();
        }
        
        //CEK sudah terpakai didokumen ini belum
        foreach ($dokumen->jaminan as $dokjam ) {
            if($dokjam->id == $jaminan->id){
                Alert::error('Jaminan Sudah dipakai');
                return back();
            }
        }

        // CEK SALDO YNG TERPAKAI oleh jaminan
        $saldoTerpakai = DB::table('dokumen_jaminan')
        ->select(DB::raw('SUM(dokumen_detail.bayar_total) as total'))
        ->join('dokumen', 'dokumen.id', '=', 'dokumen_jaminan.dokumen_id')
        ->join('jaminan', 'jaminan.id', '=', 'dokumen_jaminan.jaminan_id')
        ->join('dokumen_detail', 'dokumen_detail.dokumen_id', '=', 'dokumen.id')
        ->where('jaminan.id', $jaminan->id)
        ->where('dokumen.status_id', '<', 7)
        ->first();

        // total pembayaran dokumen ini
        $dok_bayar = $dokumen->detail->sum('bayar_total');
        // jumlah saldo + total saat ini
        $pengurang = $saldoTerpakai->total + $dok_bayar;        


        //CEK TOTAL JAMINAN
        // YANG SEKARANG ADA DIDOKUMEN
        // YANG SEKARANG DI JAMINAN TERUS MENERUS
        $jaminanYgAda = $dokumen->jaminan->sum('jumlah');
        $jaminanYgDitambahkan = $jaminan->jumlah;
        // total jaminan
        $jumlahJaminan = $jaminanYgAda + $jaminanYgDitambahkan;
        //sisa jaminan
        $sisaJaminan = $jumlahJaminan - $pengurang;

        
        
        if ($sisaJaminan < 0) {
            Alert::error('Kekurangan Jaminan ' . number_format($sisaJaminan,0,',','.'));

            return back();
        } else {
            $jaminan->dokumen()->attach($dokumen_id);    
            Alert::success('Berhasil ditambahkan');
    
            return back();

        }

    }

    public function unlink($jaminan_id, $dokumen_id){
        if(Gate::denies('EDIT-JAMINAN'))
        {
            Alert::error('Sorry');
            return back();
        }

        
        $jaminan = Jaminan::findOrFail($jaminan_id);
        
        $dokumen = Dokumen::findOrFail($dokumen_id);
        
        if($dokumen->status_id >= 5 ){
            Alert::error('sudah SPPB');
            return back();
        }
        
        $jaminan->dokumen()->detach($dokumen_id);   

        Alert::success('Berhasil Unlink');

        return back();
    }

    public function dataJaminanTerusMenerus(){
        if(Gate::denies('VIEW-DOKUMEN'))
        {
            Alert::error('Sorry');
            return back();
        }
            $jaminan = Jaminan::where('jenis_id', 2)->where('status', 'AKTIF')->get();
            return Datatables::of($jaminan)
            ->addColumn('action', function ($jaminan) {
                return '<a href="/jaminan/attachjaminantodokumen/'.$jaminan->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Gunakan</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
}