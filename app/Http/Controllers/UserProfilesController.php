<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\UserProfiles;
use Illuminate\Http\Request;

class UserProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);


        if($user->user_is == 'ppjk' or $user->user_is == 'importir')
        {
            return view('profile-pengguna-jasa.index');
        } else {
            return view('profile-pegawai.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail(auth()->user()->id);

        if($user->user_is == 'ppjk' or $user->user_is == 'importir')
        {
            return view('profile-pengguna-jasa.create');
        } else {
            return 'bukan pengguna jasa';
        }
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
            'nama_perusahaan' => 'required|min:4',
            'alamat_perusahaan' => 'required|min:4',
            'npwp' => 'required|min:4',
        ]);

        $user = User::findOrFail(auth()->user()->id);

        if($user->user_is == 'ppjk' or $user->user_is == 'importir')
        {
            $profile = new UserProfiles;
            $profile->user_id = auth()->user()->id;
            $profile->nama_perusahaan = $request->nama_perusahaan;
            $profile->alamat_perusahaan = $request->alamat_perusahaan;
            $profile->npwp = $request->npwp;
            $profile->nik = $request->nik;
            $profile->api = $request->api;
            $profile->save();

            return back();
        } else {
            return 'bukan pengguna jasa';
        }

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
        //
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
        //
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
