<?php

namespace App\Http\Controllers;

use Alert;
use App\Dokumen;
use App\DokumenPelengkap;
use Illuminate\Http\Request;
use File;

class DokumenPelengkapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'dok_id' => 'required',
            'nama_dok' => 'required',
            'no_dok' => 'required',
            'file_dok'  => 'mimes:pdf,png,jpg,jpeg|max:10240',
        ]);

        $dokumen = Dokumen::findOrFail($request->dok_id);

        $dokPel = new DokumenPelengkap;
        $dokPel->dokumen_id= $dokumen->id;
        $dokPel->nama= $request->nama_dok;
        $dokPel->nomor = $request->no_dok;
        $dokPel->tgl = $request->tgl_dok;
        //jika ada file
        if($request->hasFile('file_dok'))
        {
            //jika berhasil diupload
            if($request->file('file_dok')->isValid()){
                $size = File::size($request->file_dok);
                $fileName = $request->file_dok->hashName();
                $request->file_dok->storeAs('public\dokumen_pelengkap', $fileName);
                $dokPel->file = $fileName;
                $dokPel->size = $size;
            } else {
                Alert::error('File tidak berhasil diupload');
                return back();
            }
        } else {
            Alert::error('Tidak ada File');
            return back();
        }
        $dokPel->save();

        Alert::success('Berhasil Disimpan');
        return redirect()->route('dokumen.show', $dokumen->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DokumenPelengkap  $dokumenPelengkap
     * @return \Illuminate\Http\Response
     */
    public function show(DokumenPelengkap $dokumenPelengkap)
    {
        // dd($dokumenPelengkap->file);
        return response()->file("storage/dokumen_pelengkap//$dokumenPelengkap->file");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DokumenPelengkap  $dokumenPelengkap
     * @return \Illuminate\Http\Response
     */
    public function edit(DokumenPelengkap $dokumenPelengkap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DokumenPelengkap  $dokumenPelengkap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DokumenPelengkap $dokumenPelengkap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DokumenPelengkap  $dokumenPelengkap
     * @return \Illuminate\Http\Response
     */
    public function destroy(DokumenPelengkap $dokumenPelengkap)
    {

         if($dokumenPelengkap->dokumen->status_id > 2 || $dokumenDetail->dokumen->created_by != auth()->user()->id){
                Alert::error('Error not user or status');
                return back();
        }

        $exists = file_exists("storage/dokumen_pelengkap/". $dokumenPelengkap->file);
        
        if($exists){
            unlink("storage/dokumen_pelengkap/". $dokumenPelengkap->file);
        }
        $dokumenPelengkap->delete();

        Alert::success('Berhasil Dihapus');

        return back();
    }
}
