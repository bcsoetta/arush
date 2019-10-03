<?php

namespace App;

use Carbon\carbon;
use App\Penomoran;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    protected $table = 'laporan_ba_jaminan_harian';

    public function setTglPelaporanAttribute($value)
    {
        $this->attributes['tgl_pelaporan'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setTglJaminanAwalAttribute($value)
    {
        $this->attributes['tgl_jaminan_awal'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function setTglJaminanAkhirAttribute($value)
    {
        $this->attributes['tgl_jaminan_akhir'] = strlen($value)? Carbon::createFromFormat('d-m-Y', $value) : null;
    }

    public function penomoran($codeNomor)
    {
        $tahun = date('Y');

        if (!$codeNomor) {
            dd('tidak ada code nomor');
            die;
        }
        //CEK NOMOR
        $adaNomor = Penomoran::where('tahun', $tahun)->where('kode', $codeNomor)->first();

        //#code nomor
        //NOMOR_RH
        //NOMOR_IP
        //NOMOR_LHP
        //NOMOR_BA
        //NOMOR_SPPB
        //NOMOR_JAMINAN
        
        //JIKA TIDAK ADA
        if ($adaNomor == null){
            $nomorBaru = new Penomoran;
            $nomorBaru->nomor = 1;
            $nomorBaru->kode = $codeNomor;
            $nomorBaru->tahun = $tahun;
            $nomorBaru->save();
            $nomor = $nomorBaru->nomor;
        } else{
            $adaNomor->nomor = $adaNomor->nomor + 1;
            $adaNomor->save();
            $nomor = $adaNomor->nomor;
        }
        return $nomor;
    }

    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        
        return $temp;
    }

    public function getNomorAttribute($value)
    {
        $value = str_pad($value, 4, '0', STR_PAD_LEFT);
        return $value;
    }

    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

}
