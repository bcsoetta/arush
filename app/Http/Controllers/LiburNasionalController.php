<?php

namespace App\Http\Controllers;

use App\LiburNasional;
use Illuminate\Http\Request;
use Alert;

class LiburNasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liburNasional = LiburNasional::orderBy('tgl', 'desc')->get();

        // $libur = LiburNasional::select('tgl')->get()->toArray();

        // dd($libur);

        return view('libur-nasional.index', compact('liburNasional'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libur-nasional.create');
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
            'tgl' => 'required',
            'label' => 'required'
        ]);

        $libur = new LiburNasional;
        $libur->tgl = $request->tgl;
        $libur->label = $request->label;
        $libur->save();

        Alert::success('Berhasil disimpan');

        return redirect()->route('libur-nasional.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LiburNasional  $liburNasional
     * @return \Illuminate\Http\Response
     */
    public function show(LiburNasional $liburNasional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LiburNasional  $liburNasional
     * @return \Illuminate\Http\Response
     */
    public function edit(LiburNasional $liburNasional)
    {
        return view('libur-nasional.edit', compact('liburNasional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiburNasional  $liburNasional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiburNasional $liburNasional)
    {
        $this->validate($request,[
            'tgl' => 'required',
            'label' => 'required'
        ]);

        $liburNasional->tgl = $request->tgl;
        $liburNasional->label = $request->label;
        $liburNasional->update();

        Alert::success('Berhasil diupdate');
        return redirect()->route('libur-nasional.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiburNasional  $liburNasional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libur= LiburNasional::findOrFail($id);
        $libur->delete();
        Alert::success('Berhasil dihapus');
        return redirect()->route('libur-nasional.index');
    }
}
