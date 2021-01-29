<?php

namespace App\Http\Controllers;

use Alert;
use App\Kurs;
use Illuminate\Support\Facades\DB;
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
        $this->validate($request, [
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
        $this->validate($request, [
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
        $kurs->tgl_awal = date_create_from_format('d-m-Y', $request->berlaku);
        $kurs->tgl_akhir = date_create_from_format('d-m-Y', $request->sampai);
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

    // public function updateAll()
    // {
    //     $url = 'http://192.168.146.226/utiliti/updatekursrh.php';
    //     Alert::success('Update');
    //     return redirect()->away($url);        

    // }

    public function updateAllx()
    {
        $queries = array();
        $validity = array();

        $months = array(
            'January', 'Januari', 'February', 'Pebruari', 'Februari', 'March', 'Maret', 'April', 'May', 'Mei', 'June', 'Juni',
            'July', 'Juli', 'August', 'Agustus', 'September', 'October', 'Oktober', 'November', 'Nopember', 'December', 'Desember'
        );
        $month_ids = array(
            '01', '01', '02', '02', '02', '03', '03', '04', '05', '05', '06', '06', '07', '07', '08', '08', '09', '10', '10',
            '11', '11', '12', '12'
        );

        $doc = new \DOMDocument;
        dd(@$doc->loadHTML(file_get_contents('https://www.fiskal.kemenkeu.go.id/dw-kurs-db.asp')));
        if (@$doc->loadHTML(file_get_contents('https://fiskal.kemenkeu.go.id/dw-kurs-db.asp'))) {
            dd($doc);
            $tds = $doc->getElementsByTagName('td');

            $valuta;

            $ccc = array();

            foreach ($tds as $td) {
                $value = $td->nodeValue;

                $matches;
                if (preg_match('/\(([^\)]*)\)/', $value, $matches)) {
                    $valuta = $matches[1];

                    continue;
                }

                if (isset($valuta)) {
                    $value = (float)$this->grab_number($td->nodeValue) * 1.0;

                    if (strlen($valuta) === 3) {
                        if ($valuta == "JPY") {
                            $value *= 0.01;
                        };
                        // $data = Kurs::where('code', $valuta)->first();
                        // $data->nilai = $value;
                        // $data->save();
                        DB::table('kurs')
                            ->where('code', $valuta)
                            ->update(['nilai' => $value]);
                        $valuta = '';
                    }
                }
            }




            $cnt = 0;
            $started = 0;
            $ps = $doc->getElementsByTagName('em')->item(0);

            $textTanggal = trim($ps->nodeValue);

            $textTanggal = explode(':', $textTanggal);

            $tgl = explode('-', $textTanggal[1]);

            $tgl_awal = trim($tgl[0]);
            $tgl_akhir = trim($tgl[1]);

            $tgl_awal = str_replace($months, $month_ids, $tgl_awal);
            $tgl_akhir = str_replace($months, $month_ids, $tgl_akhir);

            $tgl_awal = date_create_from_format("d m Y", $tgl_awal);
            $tgl_akhir = date_create_from_format("d m Y", $tgl_akhir);
            DB::table('kurs')->update(['tgl_awal' => $tgl_awal]);
            DB::table('kurs')->update(['tgl_akhir' => $tgl_akhir]);
        } else {
            Alert::error('Failed to load url fiskal');
        }

        Alert::success('Update kurs');

        return redirect()->back();
    }

    public function grab_number($kmk)
    {
        // $data = str_replace('.', '', $kmk);
        // return str_replace(',', '.', $data);
        return str_replace(',', '', $kmk);
        // dd($kmk);
    }

    public function updateAll()
    {
        $monthLookup = array(
            'Januari'    => '01',
            'January'    => '01',
            'Februari'    => '02',
            'February'    => '02',
            'Pebruary'    => '02',
            'Pebruari'    => '02',
            'Maret'        => '03',
            'March'        => '03',
            'April'        => '04',
            'Mei'        => '05',
            'May'        => '05',
            'Juni'        => '06',
            'June'        => '06',
            'Juli'        => '07',
            'July'        => '07',
            'Agustus'    => '08',
            'August'    => '08',
            'September'    => '09',
            'Oktober'    => '10',
            'October'    => '10',
            'Nopember'    => '11',
            'November'    => '11',
            'Desember'    => '12',
            'December'    => '12'
        );
        // ssl context (BYPASS SSL)
        $arrContextOptions = array(
            "ssl" => array(
                "cafile" => "/home/services/kurs_kemenkeu.crt",
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        // source data
        // source data
        try {
            //code...
            $html = file_get_contents('https://fiskal.kemenkeu.go.id/informasi-publik/kurs-pajak', false, stream_context_create($arrContextOptions));
        } catch (\Exception $e) {
            // return empty data, will be interpreted as service unavailable
            return $e;
        }



        // echo $html;

        // grab tanggal awal dan akhir
        // $patTanggal = '/Tanggal Berlaku\:\s(\d{1,2})\s+(\w+)\s+(\d{4})\s\-\s(\d{1,2})\s+(\w+)\s+(\d{4})/i';
        $patTanggal = '/Tanggal Berlaku\:\s+(\d{1,2})\s+(\w+)\s+(\d{4})\s+\-\s+(\d{1,2})\s+(\w+)\s+(\d{4})/i';
        $result = preg_match($patTanggal, $html, $matches);

        if (count($matches) >= 6) {
            // fix tanggal
            if (strlen($matches[1]) == 1)
                $matches[1] = '0' . $matches[1];

            if (strlen($matches[4]) == 1)
                $matches[4] = '0' . $matches[4];

            $retData = array(
                'dateStart'    => $matches[3] . '-' . $monthLookup[$matches[2]] . '-' . $matches[1],
                'dateEnd'    => $matches[6] . '-' . $monthLookup[$matches[5]] . '-' . $matches[4],
                'data' => array()
            );
        } else {
            Alert::error('no data');
            return redirect()->back();
        }
        // grab data asli (KODE KURS + NILAI TUKARNYA)
        // $patKurs = '/\(([A-Z]{3})\).+.+>(.+)\s<img/';
        // $patKurs = '/\((\w{3})\)<\/td>\s+<td.+>\s+<img.+\/>\s+([0-9\,\.]+)<\/td>/';
        $patKurs = '/\((\w{3})\)<\/td>\s.+\s.+\s.+>([0-9]{1,3}\.[0-9]{3}\,[0-9]{2,})<\/div>/';

        $result = preg_match_all($patKurs, $html, $matches);
        // dd($matches);

        if (count($matches) > 2) {
            // dump it all?
            for ($i = 0; $i < count($matches[0]); $i++) {
                $kdValuta = $matches[1][$i];

                // FIX: AUTO-DETECT NUMBER FORMAT. CHECK RIGHT MOST
                $comma = substr($matches[2][$i], -3, 1);

                if ($comma == ',') {
                    // some idiot at BKF decides to use comma as decimal separator					
                    $nilai = str_replace('.', '', $matches[2][$i]);
                    $nilai = str_replace(',', '.', $nilai);
                } else if ($comma == '.') {
                    // the usual format. just remove all commas
                    $nilai = str_replace(',', '', $matches[2][$i]);
                } else {
                    // must be error. throw something
                    throw new \Exception("Unknown decimal separator '{$comma}'", 400);
                }


                $kurs = $nilai * 1;

                // for JPY, divide further by 100
                if ($kdValuta == 'JPY')
                    $kurs /= 100.0;

                // echo $kdValuta . ' = ' . sprintf("%.4f", $kurs) . "\n";

                // just plug it in I guess
                $retData['data'][$kdValuta] = sprintf("%.4f", $kurs);
            }
        } else {
            Alert::error('no data');
            return redirect()->back();
        }

        // dd($retData);

        if (isset($retData)) {
            foreach ($retData['data'] as $key => $value) {
                $valuta = DB::table('kurs')->where('code', $key)->get();
                if (count($valuta) > 0) {
                    //jika sudah ada
                    DB::table('kurs')
                        ->where('code', $key)
                        ->update(['nilai' => $value]);
                } else {
                    //jika belum ada ada
                    DB::table('kurs')->insert(
                        ['code' => $key, 'label' => $key, 'nilai' => $value]
                    );
                }
            }
            DB::table('kurs')->update(['tgl_awal' => $retData['dateStart']]);
            DB::table('kurs')->update(['tgl_akhir' => $retData['dateEnd']]);

            Alert::success('Update kurs');
            return redirect()->back();
        } else {
            Alert::error('no data');
            return redirect()->back();
        }
    }
}
