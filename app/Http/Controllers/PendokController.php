<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\DokumenDefinitif;
use App\Sppb;
use App\GateOut;
use App\Setatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
            'tanggal' => 'required|date'
        ]);

        $setatus = Setatus::findOrFail(9);
        $dokumen = Dokumen::findOrFail($id);
        //mau disimpan kemana
        $definitif = new DokumenDefinitif;
        $definitif->dokumen_id = $dokumen->id;
        $definitif->jenis = $request->jenis;
        $definitif->nomor = $request->nomor;
        $definitif->tanggal = $request->tanggal;
        $definitif->pendok_id = auth()->user()->id;;
        $definitif->pendok_nama = auth()->user()->nip;
        $definitif->pendok_nip = auth()->user()->name;
        $definitif->save();

        $dokumen->status_id = $setatus->id;
        $dokumen->status_label = $setatus->label;
        $dokumen->save();

        Alert::success('Penerimaan dokumen berhasil');

        return redirect()->route('gateout.index');
    }
}
