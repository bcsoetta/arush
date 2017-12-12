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

    public function updateAll()
    {
        $url = 'http://192.168.146.226/utiliti/updatekursrh.php';
        Alert::success('Update');
        return redirect()->away($url);        

    }

    // public function updateAll()
    // {
    //     $queries=array();
    //     $validity=array();

    //     //untuk konverter
    //     $months=array(
    //         'January', 'Januari', 'February', 'Pebruari', 'Februari', 'March', 'Maret', 'April', 'May', 'Mei', 'June', 'Juni',
    //         'July', 'Juli', 'August', 'Agustus', 'September', 'October', 'Oktober', 'November', 'Nopember', 'December', 'Desember'
    //     );
    //     $month_ids=array(
    //         '01', '01', '02', '02', '02', '03', '03', '04', '05', '05', '06', '06', '07', '07', '08', '08', '09', '10', '10',
    //         '11', '11', '12', '12'
    //     );

    //     $doc = new \DOMDocument;

    //     if(@$doc->loadHTMLFile('http://www.fiskal.kemenkeu.go.id/dw-kurs-db.asp'))
    //     {
    //         // dd($doc);
    //         $tds=$doc->getElementsByTagName('td');

    //         $valuta;
    //         foreach ($tds as $td) {
    //             $value=$td->nodeValue;
    //             // var_dump($value);
    //             $matches;
    //             if(preg_match('/\(([^\)]*)\)/', $value, $matches)){
    //                 //echo $matches[1]."<br>";
    //                 $valuta=$matches[1];
    //                 continue;
    //             }

    //             if(isset($valuta)){
    //                 // var_dump($valuta);
    //                 $value = $this->grab_number($td->nodeValue);
    //                 if(strlen($valuta)===3){
    //                     $data = Kurs::where('code', $valuta)->first();

    //                     $kurs = Kurs::findOrFail($data->id);
    //                     dd($kurs);
    //                     $kurs->nilai = $value;
    //                     $kurs->save();
    //                 }


    //                 // var_dump($value);
    //             }
    //         }


    //     } else {
    //         echo 'none';
    //     }
        
    // }

    public function grab_number($kmk)
    {
        $data = str_replace(',', '', $kmk);
        return str_replace(',', '.', $data);
    }
}
