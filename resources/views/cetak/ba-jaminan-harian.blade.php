<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita Acara Penyerahan Jaminan Harian</title>
</head><body>
    <p style="text-align: center; font-weight: bold; font-size: 20px; margin-bottom: 0px">BERITA ACARA PENYERAHAN JAMINAN</p>
        <p style="padding: 0; margin: 0; text-align: center; font-weight: bold; font-size: 20px; display: inline-flex;">KEPADA BENDAHARAWAN PENERIMAAN</p>
        <hr>
    <p style="text-align: center; ">NOMOR: BA - {{$ba->nomor}}/RH/KPU.03/2018</p>
    <p style="padding-left: 41px;">Pada hari {{$ba->tanggal_indo($ba->tgl_pelaporan, TRUE)}}, yang bertanda tangan dibawah ini : </p>
    <table style="margin-left: 150px;">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$ba->name}}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{$ba->nip}}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{$ba->jabatan}}</td>
        </tr>
        <tr>
            <td>Unit</td>
            <td>:</td>
            <td>{{$ba->unit}}</td>
        </tr>
    </table>
    @if($ba->tgl_jaminan_awal == $ba->tgl_jaminan_akhir)
    <p>dengan ini menyerahkan penerimaan jaminan sebagai penerimaan harian {{$ba->tanggal_indo($ba->tgl_jaminan_awal, TRUE)}}. Pada gudang <em>Rush Handling</em> dengan perincian sebagai berikut:</p>
    @else
    <p>dengan ini menyerahkan penerimaan jaminan sebagai penerimaan harian {{$ba->tanggal_indo($ba->tgl_jaminan_awal, TRUE)}} sampai dengan {{$ba->tanggal_indo($ba->tgl_jaminan_akhir, TRUE)}}. Pada gudang <em>Rush Handling</em> dengan perincian sebagai berikut:</p>
    @endif
    <table style="border-collapse: collapse; margin-left: 150px;">
        <tr>
            <td>Bea Masuk</td>
            <td>:</td>
            <td>Rp.</td>
            <td style="text-align: right">{{number_format($dokumen_total->bm,2,",",".")}}</td>
        </tr>
        <tr>
            <td>PPN</td>
            <td>:</td>
            <td>Rp.</td>
            <td style="text-align: right">{{number_format($dokumen_total->ppn,2,",",".")}}</td>
        </tr>
        <tr>
            <td>PPNBM</td>
            <td>:</td>
            <td>Rp.</td>
            <td style="text-align: right">{{number_format($dokumen_total->ppnbm,2,",",".")}}</td>
        </tr>
        <tr>
            <td>PPH PASAL 22</td>
            <td>:</td>
            <td>Rp.</td>
            <td style="text-align: right">{{number_format($dokumen_total->pph,2,",",".")}}</td>
        </tr>
        <tr style="border-top: 2px solid black;">
            <td>Jumlah</td>
            <td>:</td>
            <td>Rp.</td>
            <td style="text-align: right">{{number_format($dokumen_total->total,2,",",".")}}</td>
        </tr>
    </table>
    <p style="margin-left: 150px;">Terbilang:</p>
    <p style="margin-left: 150px; text-transform: uppercase;"><em><b>"{{$ba->penyebut($dokumen_total->total)}} RUPIAH"</b></em></p>
    <p>kepada Bendaharawan Penerimaan Kantor Pelayanan Utama Bea dan Cukai Tipe C Soekarno Hatta.</p>
    <p style="padding-left: 41px;">Demikian berita acara ini dibuat dengan sebenarnya untuk dipergunakan seperlunya.</p>

    <br>
    <br>
    <br>
    <br>

    <div>
        <div style="float: left;">
            <p>Yang menerima, <br> Bendaharawan Penerimaan</p>
            <br>
            <br>
            <br>
            <br>

            <p>..........................................
            <br> NIP ...................................</p>
        </div>

        <div style="float: right;">
            <p>Yang menerima, <br> Bendaharawan Pembantu Penerimaan</p>
            <br>
            <br>
            <br>
            <br>
            <p>{{$ba->name}}<br> NIP {{$ba->nip}}</p>
        </div>
    </div>

</body></html>