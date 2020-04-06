<?php

namespace App\Http\Controllers;

use Alert;
use App\Perusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_identitas = DB::table('jenis_identitas')->get();
        return view('perusahaan.create',compact('jenis_identitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required',
        ]);

        $perusahaan = new Perusahaan;
        $perusahaan->nama = $request->nama;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->jenis_identitas = $request->jenis_identitas;
        $perusahaan->no_identitas = $request->no_identitas;
        $perusahaan->save();


        Alert::success('Berhasil');
        return redirect()->route('perusahaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        $jenis_identitas = DB::table('jenis_identitas')->get();
        return view('perusahaan.edit', compact('perusahaan','jenis_identitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required',
        ]);

        $perusahaan->nama = $request->nama;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->jenis_identitas = $request->jenis_identitas;
        $perusahaan->no_identitas = $request->no_identitas;
        $perusahaan->update();

        Alert::success('Berhasil diupdate');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        //
    }
}
