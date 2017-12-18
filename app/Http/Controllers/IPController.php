<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Ip;
use App\User;
use App\Role;
use App\Setatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        $ip = Ip::where('pemeriksa_id', auth()->user()->id)->get();
        $no = 1;
        return view('instruksipemeriksaan.index', compact('ip', 'no'));
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
            $setatus = Setatus::findOrFail(3);

            $dokumen = Dokumen::findOrFail($id);

            $ip = new Ip;
            $ip->dokumen_id = $dokumen->id;
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

            $dokumen->status_id = $setatus->id;
            $dokumen->status_label = $setatus->label;
            $dokumen->save();

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
        $users = User::all('id','name', 'nip');

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
        return 'sdasdas';
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
