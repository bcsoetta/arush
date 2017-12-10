<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Setatus;
use App\Sppb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SPPBController extends Controller
{
    public function putusSppb($id)
    {
        if(Gate::denies('EDIT-SPPB'))
        {
            Alert::error('Sorry');
            return back();
        }

        $setatus = Setatus::findOrFail(7);
        $dokumen = Dokumen::findOrFail($id);

        $sppb = new Sppb;
        $sppb->dokumen_id = $dokumen->id;
        $sppb->seksi_id = auth()->user()->id;
        $sppb->seksi_nip = auth()->user()->nip;
        $sppb->seksi_nama = auth()->user()->name;
        $sppb->save();


        $dokumen->status_id = $setatus->id;
        $dokumen->status_label = $setatus->label;
        $dokumen->save();

        Alert::success('Berhasil SPPB');
        
        return back();
    }
}
