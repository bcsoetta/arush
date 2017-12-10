<?php

namespace App\Http\Controllers;

use Alert;
use App\Kurs;
use Illuminate\Http\Request;

class KursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kurs = Kurs::all();
        $no = 1;
        return view('kurs.index', compact('kurs', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kurs.create');
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
            'code' => 'required',
            'label' => 'required',
            'nilai' => 'required',
            'berlaku' => 'required',
            'sampai' => 'required',
        ]);

        $kurs = new Kurs;
        $kurs->code = $request->code;
        $kurs->label = $request->label;
        $kurs->nilai = $request->nilai;
        $kurs->tgl_awal = $request->berlaku;
        $kurs->tgl_akhir = $request->sampai;
        $kurs->save();

        Alert::success('Berhasil');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kurs  $kurs
     * @return \Illuminate\Http\Response
     */
    public function show(Kurs $kurs)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kurs  $kurs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kurs = Kurs::findOrFail($id);
        return view('kurs.edit', compact('kurs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kurs  $kurs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'code' => 'required',
            'label' => 'required',
            'nilai' => 'required',
            'berlaku' => 'required',
            'sampai' => 'required',
        ]);
        
        $kurs = Kurs::findOrFail($id);
        $kurs->code = $request->code;
        $kurs->label = $request->label;
        $kurs->nilai = $request->nilai;
        $kurs->tgl_awal = $request->berlaku;
        $kurs->tgl_akhir = $request->sampai;
        $kurs->save();

        Alert::success('Berhasil Update');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kurs  $kurs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kurs $kurs)
    {
        //
    }
}
