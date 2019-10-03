<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\Status;
use App\Sppb;
use App\LogStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class SPPBController extends Controller
{
    public function putusSppb($id)
    {
        if(Gate::denies('EDIT-SPPB'))
        {
            Alert::error('Sorry');
            return back();
        }

        $status = Status::findOrFail(5);
        $dokumen = Dokumen::findOrFail($id);
        $codePenomoran = 'NOMOR_SPPB';

        // cek sudah ada dokumen pelengkap
        if(count($dokumen->dokumenPelengkap) == 0){
            Alert::error('Dokumen Pelengkap Belum diisi');
            return back();
        }

        // cek saudah jaminan
        if(count($dokumen->jaminan) == 0){
            Alert::error('Belum memiliki jaminan');
            return back();
        }

        // cek sudah ada detail barang
        if(count($dokumen->detail) == 0){
            Alert::error('Belum memiliki detail barang');
            return back();
        }
        
        // cek IP
        if($dokumen->ip == NULL){
            Alert::error('Belum memiliki IP');
            return back();
        }

        // cek LHP
        if($dokumen->lhp == NULL){
            Alert::error('Belum memiliki LHP');
            return back();
        }


        try{
            DB::beginTransaction();
            $sppb = new Sppb;
            $sppb->dokumen_id = $dokumen->id;
            $sppb->no_sppb = $dokumen->penomoran($codePenomoran);
            $sppb->seksi_id = auth()->user()->id;
            $sppb->seksi_nip = auth()->user()->nip;
            $sppb->seksi_nama = auth()->user()->name;
            $sppb->save();

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
            Alert::success('Berhasil SPPB');    
            return back();

        } catch(\Exception $e){
            DB::rollback();

            Alert::error($e->getMessage());
            return back();
        }
    }
}
