<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Cache;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function userOnline(){
        $users = User::all();

        $onlineUser = [];

        foreach ($users as $user) {
            if(Cache::has('user-is-online-' . $user->id)){
                array_push($onlineUser, $user);
            }
        }           

        return response()->json($onlineUser);
    }

    public function statusDokumen($tahun){

        if(!is_numeric($tahun) || strlen($tahun) !== 4){
            return response()->json(['']);
        }

        $status =DB::select('
            SELECT 
                s.label, 
                COUNT(d.status_id) AS jumlah 
            FROM status AS s 
            LEFT JOIN dokumen AS d ON s.id = d.status_id
            WHERE YEAR(d.created_at) = ?
            GROUP BY s.id 
            ORDER BY s.id 
        ', [$tahun]);


        return response()->json($status);
    }
}
