<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function show(){
        $sett = DB::table('setting')->find(1);
        return view('setting.index',compact('sett'));
    }

    public function update(Request $request){

        DB::table('setting')->where('id', 1)
                    ->update([
                        'blokir' => $request->blokir
                    ]);

        Alert::success('Berhasil Disimpan');
        return redirect()->route('setting.show');
    }
}
