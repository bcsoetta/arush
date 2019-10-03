<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\DokumenDefinitif;
use App\Sppb;
use App\GateOut;
use App\Status;
use App\LogStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use DataTables;

class PendokController extends Controller
{
    public function index()
    {
        if(Gate::denies('PENDOK'))
        {
            Alert::error('Sorry');
            return back();
        }

        return view('pendok.index');
    }

    public function search(Request $request)
    {
        if(Gate::denies('PENDOK'))
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

        return view('pendok.search', compact('dokumen'));
    }

    public function create($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $detailBarang = $dokumen->detail;
        
        return view('pendok.create', compact('dokumen', 'detailBarang'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'jenis' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required|date',
            // 'billing' => 'required',
            // 'ntpn' => 'required',
            // 'tgl_ntpn' => 'required|date'
        ]);

        try{
            DB::beginTransaction();
            $status = Status::findOrFail(7);
            $dokumen = Dokumen::findOrFail($id);
            //mau disimpan kemana
            $definitif = new DokumenDefinitif;
            $definitif->dokumen_id = $dokumen->id;
            $definitif->jenis = $request->jenis;
            $definitif->nomor = $request->nomor;
            $definitif->tanggal = $request->tanggal;
            $definitif->billing = $request->billing;
            $definitif->ntpn = $request->ntpn;
            $definitif->tgl_ntpn = $request->tgl_ntpn;
            $definitif->total_bayar = $request->total_bayar;
            $definitif->pendok_id = auth()->user()->id;;
            $definitif->pendok_nama = auth()->user()->name;
            $definitif->pendok_nip = auth()->user()->nip;
            $definitif->save();

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
            Alert::success('Penerimaan dokumen berhasil');

            return redirect()->route('gateout.index');
            

        } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }
    }

    public function edit($id){
        $dokumen = Dokumen::findOrFail($id);
        $detailBarang = $dokumen->detail;
        
        return view('pendok.edit', compact('dokumen', 'detailBarang'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'jenis' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required|date'
        ]);


        try{
            DB::beginTransaction();
            //mau update kemana
            $definitif = DokumenDefinitif::findOrFail($id);
            $definitif->jenis = $request->jenis;
            $definitif->nomor = $request->nomor;
            $definitif->tanggal = $request->tanggal;
            $definitif->billing = $request->billing;
            $definitif->ntpn = $request->ntpn;
            $definitif->tgl_ntpn = $request->tgl_ntpn;
            $definitif->total_bayar = $request->total_bayar;
            $definitif->update();

            $StatusLog = new LogStatus;
            $StatusLog->dokumen_id = $definitif->dokumen_id;
            $StatusLog->status_id = 7;
            $StatusLog->status_label = 'Edit Definitif';
            $StatusLog->user_id = auth()->user()->id;
            $StatusLog->user_name = auth()->user()->name;
            $StatusLog->save();

            DB::commit();
            Alert::success('Penerimaan dokumen berhasil');

            // return redirect()->route('pendok.index');
            return back();
            

        } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }
    }

    
    public function data(){
        if(Gate::denies('PENDOK'))
        {
            Alert::error('Sorry');
            return back();
        }

        $dokumen= Dokumen::where('status_id', 5)
        ->orWhere('status_id', 6)
        ->get();

        return Datatables::of($dokumen)
        ->addColumn('sppb', function(Dokumen $dokumen){
            return $dokumen->sppb->no_sppb;
        })
        ->addColumn('tgl_sppb', function(Dokumen $dokumen){
            return $dokumen->sppb->created_at;
        })
        ->addColumn('action', function ($dokumen) {
            return '<a href="'. route('pendok.create', $dokumen->id) .'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Rekam Dokumen Definitif</a>';
        })
        ->make(true);
    }
}
