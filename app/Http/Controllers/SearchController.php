<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $products=DB::table('dokumen')->where('title','LIKE','%'.$request->search."%")->get();
            if($products)
            {

                foreach ($products as $key => $product) {
                    $output.='<tr>'.
                    '<td>'.$product->id.'</td>'.
                    '<td>'.$product->title.'</td>'.
                    '<td>'.$product->description.'</td>'.
                    '<td>'.$product->price.'</td>'.
                    '</tr>';
                }
            }
        }
    }    