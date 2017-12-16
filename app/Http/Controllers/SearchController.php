<?php

namespace App\Http\Controllers;

use DB;
use App\Dokumen;
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
            if (!$request->search) {
                return Response($output = '');
            }

            $output="";
            // $dokumens=DB::table('dokumen')->where('daftar_no','LIKE','%'.$request->search."%")->get();

            $dokumens = Dokumen::where('daftar_no','LIKE','%'.$request->search.'%')
                        ->orWhere('mawb_no','LIKE','%'.$request->search.'%')
                        ->orWhere('hawb_no','LIKE','%'.$request->search.'%')
                        ->orWhere('importir_nm','LIKE','%'.$request->search.'%')
                        ->orWhere('ppjk_nm','LIKE','%'.$request->search.'%')
                        ->get();

            if($dokumens)
            {

                foreach ($dokumens as $key => $dokumen) {
                    $output.='<tr>'.
                    '<td>'.$dokumen->daftar_no.'</td>'.
                    '<td>'.$dokumen->importir_nm.'</td>'.
                    '<td>'.$dokumen->ppjk_nm.'</td>'.
                    '<td>'.$dokumen->hawb_no.'</td>'.
                    '<td>'.$dokumen->status_label.'</td>'.
                    '</tr>';
                }
            }

            return Response($output);
        }
    }

    public function importir(Request $request)
    {
        $term = trim($request->term);

        // if (empty($term)) {
        //     return response()->json([]);
        // }

        
        $queries = DB::table('view_importir')->where('importir_nama','LIKE', '%'.$term.'%')->take(10)->get();
        
        $results=[];
        foreach ($queries as $query)
        {
            $results[] = [ 
                'value' => $query->importir_nama,
                'npwp' => $query->importir_npwp,
                'alamat' => $query->importir_alamat
            ];
        }
        return response()->json($results);
    }

    public function ppjk(Request $request)
    {
        $term = trim($request->term);

        if (empty($term)) {
            return response()->json([]);
        }

        
        $queries = DB::table('view_ppjk')->where('ppjk_nama','LIKE', '%'.$term.'%')->take(10)->get();
        
        $results=[];
        foreach ($queries as $query)
        {
            $results[] = [ 
                'value' => $query->ppjk_nama,
                'npwp' => $query->ppjk_npwp,
                'alamat' => $query->ppjk_alamat
            ];
        }
        return response()->json($results);
    }
} 