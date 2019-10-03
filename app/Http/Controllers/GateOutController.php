<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Sppb;
use App\GateOut;
use App\Status;
use App\LogStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use DataTables;

class GateOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gate-out.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if($dokumen->status_id < 5){
            Alert::error('Bukan SPPB');
            return back();

        }

        if(Gate::denies('VIEW-GATE'))
        {
            Alert::error('Sorry');
            return back();
        }

        
        $detailBarang = $dokumen->detail;
        
        return view('gate-out.create', compact('dokumen', 'detailBarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'catatan' => 'required'
        ]);
        try{
            DB::beginTransaction();
            $status = Status::findOrFail(6);
            $dokumen = Dokumen::findOrFail($id);

            $sppb = Sppb::where('dokumen_id', $dokumen->id)->first();
            $sppb->catatan_pengeluaran = $request->catatan;
            $sppb->gate_id = auth()->user()->id;;
            $sppb->gate_nama = auth()->user()->name;
            $sppb->gate_nip = auth()->user()->nip;
            $sppb->waktu_keluar = now();
            $sppb->update();

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
            
            Alert::success('Perekaman pengeluaran Berhasil');
            return redirect()->route('gateout.index');
            

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
        return '';
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

    public function search(Request $request)
    {
        if(Gate::denies('VIEW-GATE'))
        {
            Alert::error('Sorry');
            return back();
        }

        $this->validate($request,[
            'search' => 'required'
        ]);

        $search = $request->search;
        $dokumen = Dokumen::where('daftar_no','LIKE','%'.$search.'%')
        ->orWhere('mawb_no','LIKE','%'.$search.'%')
        ->orWhere('hawb_no','LIKE','%'.$search.'%')
        ->orWhere('importir_nm','LIKE','%'.$search.'%')
        ->orWhere('ppjk_nm','LIKE','%'.$search.'%')
        ->get();

        return view('gate-out.search', compact('dokumen'));
    }

    public function data(){
        if(Gate::denies('VIEW-GATE'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen = Dokumen::where('status_id', '5')->get();

        return Datatables::of($dokumen)
        ->addColumn('sppb', function(Dokumen $dokumen){
            return $dokumen->sppb->no_sppb;
        })
        ->addColumn('tgl_sppb', function(Dokumen $dokumen){
            return $dokumen->sppb->created_at;
        })
        ->addColumn('action', function ($dokumen) {
            return '<a href="'. route('gateout.create', $dokumen->id) .'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Proses pengeluaran</a>';
        })
        ->make(true);
    }
}
