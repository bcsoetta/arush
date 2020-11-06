<?php

namespace App\Http\Controllers;

use App\BlokirKhusus;
use App\Perusahaan;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Gate;

class BlokirKhususController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('SET-BLOKIR-KHUSUS')) {
            Alert::error('Sorry');
            return back();
        }
        $blokir = BlokirKhusus::get();
        return view('blokir-khusus.index', compact('blokir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('SET-BLOKIR-KHUSUS')) {
            Alert::error('Sorry');
            return back();
        }

        return view('blokir-khusus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('SET-BLOKIR-KHUSUS')) {
            Alert::error('Sorry');
            return back();
        }
        $this->validate($request, [
            'no_identitas' => 'required',
            'nama' => 'required',
            'nomor_surat' => 'required',
            'hal' => 'required',
            'keterangan' => 'required',
        ]);

        $blokir = new BlokirKhusus;
        $blokir->no_identitas = $request->no_identitas;
        $blokir->nama = $request->nama;
        $blokir->nomor_surat = $request->nomor_surat;
        $blokir->hal = $request->hal;
        $blokir->keterangan = $request->keterangan;
        $blokir->perekam_id = auth()->user()->id;
        $blokir->save();


        Alert::success('Berhasil');
        return redirect()->route('blokir-khusus.index');
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
        if (Gate::denies('SET-BLOKIR-KHUSUS')) {
            Alert::error('Sorry');
            return back();
        }

        $data = BlokirKhusus::findOrFail($id);
        return view('blokir-khusus.edit', compact('data'));
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
        if (Gate::denies('SET-BLOKIR-KHUSUS')) {
            Alert::error('Sorry');
            return back();
        }
        $this->validate($request, [
            'no_identitas' => 'required',
            'nama' => 'required',
            'nomor_surat' => 'required',
            'hal' => 'required',
            'keterangan' => 'required',
        ]);

        $blokir = BlokirKhusus::findOrFail($id);
        $blokir->no_identitas = $request->no_identitas;
        $blokir->nama = $request->nama;
        $blokir->nomor_surat = $request->nomor_surat;
        $blokir->hal = $request->hal;
        $blokir->keterangan = $request->keterangan;
        $blokir->update();

        Alert::success('Berhasil diupdate');
        return back();
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

    public function buka($id)
    {
        if (Gate::denies('SET-BLOKIR-KHUSUS')) {
            Alert::error('Sorry');
            return back();
        }
        $data = BlokirKhusus::findOrFail($id);
        return view('blokir-khusus.buka', compact('data'));
    }

    public function penyelesaian(Request $request, $id)
    {
        if (Gate::denies('SET-BLOKIR-KHUSUS')) {
            Alert::error('Sorry');
            return back();
        }
        $this->validate($request, [
            'penyelesaian' => 'required',
            'blokir' => 'required',
        ]);

        $blokir = BlokirKhusus::findOrFail($id);
        $blokir->blokir = $request->blokir;
        $blokir->penyelesaian = $request->penyelesaian;
        $blokir->updated_by = auth()->user()->id;
        $blokir->update();

        Alert::success('Berhasil diupdate');
        return back();
    }
}
