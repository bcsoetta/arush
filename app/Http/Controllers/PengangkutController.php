<?php

namespace App\Http\Controllers;

use Alert;
use App\Pengangkut;
use Illuminate\Http\Request;

class PengangkutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengangkut = Pengangkut::orderBy('kode')->paginate(20);
        $no = 1;
        return view('pengangkut.index', compact('pengangkut', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengangkut.create');
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
            'voy' => 'required',
            'pesawat' => 'required'
        ]);

        $pengangkut = new Pengangkut;
        $pengangkut->kode = strtoupper($request->voy);
        $pengangkut->pesawat = strtoupper($request->pesawat);
        $pengangkut->save();
        Alert::success('Berhasil disimpan');
        return redirect()->route('pengangkut.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengangkut = Pengangkut::findOrFail($id);
        return view('pengangkut.edit', compact('pengangkut'));
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
            'voy' => 'required',
            'pesawat' => 'required'
        ]);

        $pengangkut = Pengangkut::findOrFail($id);
        $pengangkut->kode = strtoupper($request->voy);
        $pengangkut->Pesawat = strtoupper($request->pesawat);
        $pengangkut->save();

        Alert::success('Berhasil disimpan');
        return redirect()->route('pengangkut.index');
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
}
