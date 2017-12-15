<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        // $users = User::where('active', 1)->orderBy('hadir', 'desc')->paginate(20);
        $users = User::where('active', 1)->whereHas('roles', function($q){
            $q->where('name', 'PEMERIKSA');
        })->orderBy('hadir', 'desc')->paginate(20);
        $no =1;
        return view('absensi.index', compact('users', 'no'));
    }

    public function ubahKehadiran($id)
    {
        $user = User::findOrFail($id);

        if($user->hadir == 1){
            $user->hadir = 0;
        }else{
            $user->hadir = 1;
        }

        $user->update();

        return back();
    }
}
