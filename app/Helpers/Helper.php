<?php

if (! function_exists('tgl_indo')) {
    function tgl_indo($value, $default = null) {
        if ($value) {
            # code...
            return date('d-m-Y', strtotime($value));
        } else {
            return $default;
        }
    }
}

if (! function_exists('tgl_indo_time')) {
    function tgl_indo_time($value, $default = null) {
        return date('d-m-Y H:i:s', strtotime($value));
    }
}

if (! function_exists('hari_kerja')) {
   //fungsi menerima tanggal string format Y-m-d
    //return integer
    function hari_kerja($tglAwal, $tglAkhir){

        $tglAwal = strtotime($tglAwal);
        $tglAkhir = strtotime($tglAkhir);
        
        //buat array
        $hariKerja = array();
        $sabtuminggu = array();
        
        for ($i=$tglAwal; $i <= $tglAkhir; $i += (60 * 60 * 24)) {
            if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                $hariKerja[] = $i;
            } else {
                $sabtuminggu[] = $i;
            }
        
        }

        //tgl libur Nasional string Y-m-d
        $tglLiburNasional = App\LiburNasional::select('tgl')->get();

        //buat array
        $liburNasional=array();
        $liburNasionalSabtuMinggu=array();

        foreach ($tglLiburNasional as $tglLibur) {

            $tglLibur = strtotime($tglLibur->tgl);
            //Cek apakah tgl lebih kecil atau lebih besar dari tgl awal atau akhir
            if($tglLibur <= $tglAkhir and $tglLibur >= $tglAwal ){
                //CEK APAKAH HARI MINGGU ATAU TIDAK
                if (date('w', $tglLibur) !== '0' && date('w', $tglLibur) !== '6') {
                    $liburNasional[] = $tglLibur;
                } else {
                    $liburNasionalSabtuMinggu[] = $tglLibur;
                }
            }
            
        }

        $jlhHariKerja = count($hariKerja) - count($liburNasional);
        return $jlhHariKerja;

    }
}