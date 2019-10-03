<?php

namespace App\Http\Controllers;

use App\Hs;
use Illuminate\Http\Request;

class HsController extends Controller
{
    public function dataHs(Request $request)
    {
        $term = trim($request->q, '.');
        //$term = '02101990';
        return Hs::where('id_hs_code', 'LIKE', $term."%")->orWhere('uraian', 'LIKE', $term."%")->paginate(10);
    }
}
