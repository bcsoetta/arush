<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Ip;
use App\User;
use App\Role;
use App\Status;
use App\LogStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use DataTables;

use Illuminate\Http\Request;

class IPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW-IP'))
        {
            Alert::error('Sorry');
            return back();
        }
        

        return view('instruksipemeriksaan.index');
    }


    public function dataIp(){
        if(Gate::denies('VIEW-IP'))
        {
            Alert::error('Sorry');
            return back();
        }
        


        if (auth()->user()->hasRole('PEMERIKSA')) {
            $ip = DB::table('dokumen_ip')
                    ->select(
                        'dokumen.id as id',
                        'dokumen.status_id',
                        'dokumen.daftar_no as nomor',
                        'dokumen.daftar_tgl as tgl',
                        'dokumen.importir_nm as importir',
                        'dokumen.hawb_no as awb',
                        'dokumen_ip.no_ip as no_ip',
                        'dokumen_ip.created_at as ip_tgl',
                        'dokumen_ip.pemeriksa_nama as pemeriksa',
                        'dokumen_ip.tingkat_periksa',
                        'dokumen_ip.aju_contoh',
                        'dokumen_ip.aju_foto',
                        'dokumen_ip.pemeriksa_id',
                        'dokumen.updated_at'
                        )
                    ->join('dokumen', 'dokumen_ip.dokumen_id', '=','dokumen.id')
                    ->where('dokumen_ip.pemeriksa_id', auth()->user()->id);
        }
        
        if (auth()->user()->hasRole('ADMIN')) {
            $ip = DB::table('dokumen_ip')
                    ->select(
                        'dokumen.id as id',
                        'dokumen.status_id',
                        'dokumen.daftar_no as nomor',
                        'dokumen.daftar_tgl as tgl',
                        'dokumen.importir_nm as importir',
                        'dokumen.hawb_no as awb',
                        'dokumen_ip.no_ip as no_ip',
                        'dokumen_ip.created_at as ip_tgl',
                        'dokumen_ip.pemeriksa_nama as pemeriksa',
                        'dokumen_ip.tingkat_periksa',
                        'dokumen_ip.aju_contoh',
                        'dokumen_ip.aju_foto',
                        'dokumen.updated_at'
                        )
                    ->join('dokumen', 'dokumen_ip.dokumen_id', '=','dokumen.id');
        }



            return Datatables::of($ip)
                ->editColumn('tgl', function($ip){
                    return date('d-m-Y', strtotime($ip->tgl));
                })
                ->editColumn('ip_tgl', function($ip){
                    return date('d-m-Y', strtotime($ip->ip_tgl));
                })
                ->addColumn('action', function ($ip) {

                    $btn = '<a href="'.route('cetak.ip', $ip->id).'" class="btn btn-xs btn-primary">Cetak IP</a> ';
                    
                    //jika status rekam LHP muncul tombol rekam
                    if($ip->status_id == 3){
                        $btn = $btn . '<a href="'. route('lhp.create', $ip->id).'" class="btn btn-xs btn-danger">Rekam LHP</a>';

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
        if(Gate::denies('CREATE-IP'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = Dokumen::findOrFail($id);

        $users= User::where('active', 1)->where('hadir', 1)->whereHas('roles', function($q){
            $q->where('name', 'PEMERIKSA');
        })->get();


        return view('instruksipemeriksaan.create', compact('dokumen', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if(Gate::denies('CREATE-IP'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'pemeriksa' => 'required',
            'tingkat_periksa' => 'required',
        ]);
        try{
            DB::beginTransaction();
            $pemeriksa = User::findOrFail($request->pemeriksa);
            $status = Status::findOrFail(3);

            $dokumen = Dokumen::findOrFail($id);
            $codePenomoran = 'NOMOR_IP';

            $ip = new Ip;
            $ip->dokumen_id = $dokumen->id;
            $ip->no_ip = $dokumen->penomoran($codePenomoran);
            $ip->pemeriksa_id = $pemeriksa->id;
            $ip->pemeriksa_nip = $pemeriksa->nip;
            $ip->pemeriksa_nama = $pemeriksa->name;
            $ip->tingkat_periksa = $request->tingkat_periksa;
            $ip->jumlah_kemasan_diperiksa = $request->jumlah_kemasan_diperiksa;
            $ip->nomor_kontainer_diperiksa = $request->nomor_kontainer_diperiksa;
            $ip->nomor_kemasan_diperiksa = $request->nomor_kontainer_diperiksa;
            $ip->aju_contoh = $request->aju_contoh;
            $ip->aju_foto = $request->aju_foto;
            $ip->seksi_id = auth()->user()->id;
            $ip->seksi_nip = auth()->user()->nip;
            $ip->seksi_nama = auth()->user()->name;
            $ip->save();

            $dokumen->status_id = $status->id;
            $dokumen->status_label = $status->label;
            $dokumen->save();

            $StatusLog = new LogStatus;
            $StatusLog->dokumen_id= $dokumen->id;
            $StatusLog->status_id= $status->id;
            $StatusLog->status_label= $status->label;
            $StatusLog->user_id = auth()->user()->id;
            $StatusLog->user_name = auth()->user()->name;
            $StatusLog->save();

            DB::commit();
            Alert::success('Berhasil disimpan');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $ip = $dokumen->ip;
        return view('instruksipemeriksaan.show', compact('dokumen', 'ip'));
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
        $users= User::where('active', 1)->where('hadir', 1)->whereHas('roles', function($q){
            $q->where('name', 'PEMERIKSA');
        })->get();

        return view('instruksipemeriksaan.edit', compact('dokumen', 'users'));
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
        $this->validate($request,[
            'pemeriksa' => 'required',
            'tingkat_periksa' => 'required',
        ]);

        $pemeriksa = User::findOrFail($request->pemeriksa);

        $dokumen = Dokumen::findOrFail($id);

        $dokumen->ip->pemeriksa_id = $pemeriksa->id;
        $dokumen->ip->pemeriksa_nip = $pemeriksa->nip;
        $dokumen->ip->pemeriksa_nama = $pemeriksa->name;
        $dokumen->ip->tingkat_periksa = $request->tingkat_periksa;
        // $dokumen->ip->jumlah_kemasan_diperiksa = $request->jumlah_kemasan_diperiksa;
        // $dokumen->ip->nomor_kontainer_diperiksa = $request->nomor_kontainer_diperiksa;
        // $dokumen->ip->nomor_kemasan_diperiksa = $request->nomor_kontainer_diperiksa;
        $dokumen->ip->aju_contoh = $request->aju_contoh;
        $dokumen->ip->aju_foto = $request->aju_foto;
        // $dokumen->ip->seksi_id = auth()->user()->id;
        // $dokumen->ip->seksi_nip = auth()->user()->nip;
        // $dokumen->ip->seksi_nama = auth()->user()->name;
        $dokumen->ip->save();

        Alert::success('Berhasil disimpan');
        return redirect()->route('instruksi-pemeriksaan.show', $dokumen->id);


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

    // public function search(Request $request)
    // {

    //     $this->validate($request,[
    //         'search' => 'required'
    //     ]);

    //     $search = $request->search;
    //     $ip = Dokumen::where('daftar_no','LIKE','%'.$search.'%')->orWhere('mawb_no','LIKE','%'.$search.'%')->orWhere('hawb_no','LIKE','%'.$search.'%')->where('status_id', 3)->get();
    //     return $ip;
    //     $no = 1;
    //     return view('instruksipemeriksaan.index', compact('ip', 'no'));
    // }
}
