<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dokumen;
use App\Charts\DokumenChart;
use App\Charts\LhpChart;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class DashBoardController extends Controller
{
    public function index(){

        $dokumen = DB::select('
                SELECT
                    months.name,
                    months.id,
                MONTH(dokumen.daftar_tgl) AS dok_month,
                COUNT(dokumen.id) AS jumlah,
                YEAR(dokumen.daftar_tgl) AS tahun
                FROM months
                LEFT JOIN dokumen
                    ON months.id = MONTH(dokumen.daftar_tgl)
                WHERE YEAR(dokumen.daftar_tgl) = YEAR(CURDATE()) AND dokumen.status_id IN (5,6,7) OR MONTH(dokumen.daftar_tgl) is NULL
                GROUP BY months.name
                ORDER BY months.id
        ');

        // dd($dokumen);
        
        $labelDokumen = [];
        $dataDokumen = [];
        $sumDokumen = 0;

        foreach ($dokumen as $doc) {
            $labelDokumen[] = $doc->name;
            $dataDokumen[] = $doc->jumlah;

            if(isset($doc->jumlah)){
                $sumDokumen+= $doc->jumlah;
            }
        }


        $dokumenChart = new DokumenChart;
        $dokumenChart->title("Data Dokumen Perbulan");
        $dokumenChart->labels($labelDokumen);
        $dokumenChart->dataset('Dokumen', 'bar', $dataDokumen)
                ->backgroundColor(collect([
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ]))
                ->color(collect([
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ]));
        
        $lhp = DB::select('
                SELECT 
                    dl.pemeriksa_nama,
                    m.name AS bulan,
                    YEAR(dl.created_at) AS tahun,
                    COUNT(dl.id) AS jumlah
                FROM months AS m
                LEFT JOIN dokumen_lhp AS dl
                ON m.id = MONTH(dl.created_at)
                WHERE YEAR(dl.created_at) = YEAR(CURDATE()) AND MONTH(dl.created_at) = MONTH(CURDATE())
                GROUP BY dl.pemeriksa_id
                ORDER BY dl.pemeriksa_nama
        ');
   
        $labelLhp = [];
        $dataLhp = [];
        $sumLhp = 0;

        foreach ($lhp as $doclhp) {
            $labelLhp[] = $doclhp->pemeriksa_nama;
            $dataLhp[] = $doclhp->jumlah;

            if(isset($doclhp->jumlah)){
                $sumLhp+= $doclhp->jumlah;
            }
        }


        $lhpChart = new LhpChart;
        $lhpChart->title("Data Dokumen LHP Perbulan");
        $lhpChart->labels($labelLhp);
        $lhpChart->dataset('Lhp', 'bar', $dataLhp)
                ->backgroundColor(collect([
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ]))
                ->color(collect([
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ]));
        
        $importirTerbanyak = DB::select('
                    SELECT
                        d.importir_npwp AS npwp,
                        d.importir_nm AS nama,
                        COUNT(d.id) AS jumlah
                    FROM dokumen AS d
                    WHERE d.status_id IN (5,6,7) AND YEAR(d.daftar_tgl) = YEAR(CURDATE()) 
                    GROUP BY d.importir_npwp
                    ORDER BY COUNT(d.id) DESC 
                    LIMIT 10
        ');

        $hsTerbanyak = DB::select('
                    SELECT
                        dd.hs_code, 
                        dd.uraian_barang,
                        COUNT(dd.id) AS jumlah
                    FROM dokumen_detail AS dd
                    GROUP BY dd.hs_code
                    ORDER BY COUNT(dd.id) DESC
                    LIMIT 10
        ');

        $status =DB::select('
                    SELECT 
                        s.label, 
                        COUNT(d.status_id) AS jumlah 
                    FROM status AS s 
                    LEFT JOIN dokumen AS d ON s.id = d.status_id
                    GROUP BY s.id 
                    ORDER BY s.id 
        ');


        $sumStatus = 0;

        foreach ($status as $sts) {
            if(isset($sts->jumlah)){
                $sumStatus+= $sts->jumlah;
            }
        }

        $waktu = DB::select("
                SELECT
                YEAR(b.created_at) AS tahun,
                DATE_FORMAT(b.created_at, '%M') AS bulan,
                avg(TIMESTAMPDIFF(SECOND,a.daftar_tgl,b.created_at)/3600) AS ratarata
                FROM dokumen AS a
                INNER JOIN dokumen_sppb AS b 
                ON a.id = b.dokumen_id
                GROUP BY MONTH(b.created_at)
                ORDER BY MONTH(b.created_at) ASC
            ");


                    return view('dashboard.index', compact(
                        'dokumen',
                        'sumDokumen', 
                        'dokumenChart',
                        'lhp',
                        'lhpChart',
                        'sumLhp',
                        'importirTerbanyak',
                        'hsTerbanyak',
                        'status',
                        'sumStatus',
                        'waktu'
                    ));
    }

    // public function test(){
    //     $waktu = DB::select("
    //             SELECT
    //                 YEAR(b.created_at) AS tahun,
    //                 a.importir_npwp AS npwp_importir,
    //                 a.importir_nm AS nama_importir,
    //                 DATE_FORMAT(b.created_at, '%M') AS bulan,
    //                 avg(TIMESTAMPDIFF(SECOND,a.daftar_tgl,b.created_at)/3600) AS ratarata
    //             FROM dokumen AS a
    //             INNER JOIN dokumen_sppb AS b 
    //             ON a.id = b.dokumen_id
    //             GROUP BY MONTH(b.created_at), npwp_importir, nama_importir
    //             ORDER BY npwp_importir, MONTH(b.created_at) ASC
    //         ");

    //         return view('dashboard.importir', compact('waktu'));

    // }
}
