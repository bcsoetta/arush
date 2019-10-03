<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lampiran Berita Acara</title>
    <style>
    @media print{

div {
    page-break-inside:avoid;
}
    }
        
        table, caption, tbody, tfoot, thead, tr, th, td {
            margin: 0;
            padding: 1px;
            border: 1px solid black;
            font: inherit;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 12px;
            width: 100%;
            table-layout: fixed;
        }

        td {
            word-wrap:break-word;
        }


    </style>
</head><body>
<p style="text-align: center; font-weight: bold; font-size: 20px; margin: 0px">DAFTAR PENERIMAAN UANG JAMINAN PELAYANAN SEGERA</p>
@if($ba->tgl_jaminan_awal == $ba->tgl_jaminan_akhir)
<P style="text-align: center; font-weight: bold; font-size: 20px; margin: 0px; text-transform: uppercase;">HARI / TANGGAL : {{$ba->tanggal_indo($ba->tgl_jaminan_awal, TRUE)}}</P>
@else
<P style="text-align: center; font-weight: bold; font-size: 20px; margin: 0px; text-transform: uppercase;">HARI / TANGGAL : {{$ba->tanggal_indo($ba->tgl_jaminan_awal, TRUE)}} S.D. {{$ba->tanggal_indo($ba->tgl_jaminan_akhir, TRUE)}}</P>
@endif
<P style="text-align: center; font-weight: bold; font-size: 20px; margin: 0px">UNIT KERJA : RUSH HANDLING</P>

<table style="margin-top: 25px;">
    <thead>
        <tr>
            <th rowspan="3">NO</th>
            <th colspan="2">DOKUMEN RH</th>
            <th rowspan="3">NAMA PENJAMIN</th>
            <th colspan="5">JAMINAN</th>
            <th colspan="2">BPJ</th>
        </tr>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">TANGGAL</th>
            <th>BEA MASUK</th>
            <th>PPN</th>
            <th>PPNBM</th>
            <th>PPH</th>
            <th>JUMLAH</th>
            <th rowspan="2">NO</th>
            <th rowspan="2">TANGGAL</th>
        </tr>
        <tr>
            <th style="font-size: 70%;">(Rp.)</th>
            <th style="font-size: 70%;">(Rp.)</th>
            <th style="font-size: 70%;">(Rp.)</th>
            <th style="font-size: 70%;">(Rp.)</th>
            <th style="font-size: 70%;">(Rp.)</th>
        </tr>
    </thead>
    <tbody>
    @php
        $no=1
    @endphp
    @foreach($dokumen as $doc)
        <tr>
            <td style="text-align: center;">{{$no++}}</td>
            <td style="text-align: center;">{{str_pad($doc->daftar_no, 5, '0', STR_PAD_LEFT)}}</td>
            <td style="text-align: center;">{{date('d-m-Y', strtotime($doc->daftar_tgl))}}</td>
            <td>{{$doc->penjamin}}</td>
            <td style="text-align: right;">{{number_format($doc->bm,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($doc->ppn,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($doc->ppnbm,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($doc->pph,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($doc->total,2,",",".")}}</td>
            <td style="text-align: center;">{{str_pad($doc->nomor, 4, '0', STR_PAD_LEFT)}}</td>
            <td style="text-align: center;">{{date('d-m-Y', strtotime($doc->tanggal))}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">TOTAL</td>
            <td style="text-align: right;">{{number_format($dokumen_total->bm,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($dokumen_total->ppn,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($dokumen_total->ppnbm,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($dokumen_total->pph,2,",",".")}}</td>
            <td style="text-align: right;">{{number_format($dokumen_total->total,2,",",".")}}</td>
            <td colspan="2"></td>
        </tr>
    </tbody>
</table>
<br>
<br>
    <div>
        <div style="float: left;">
            <p>Yang menerima, <br> Bendaharawan Penerimaan</p>
            <br>
            <br>
            <p>..........................................<br> NIP ...................................</p>
        </div>

        <div style="float: right;">
            <p>{{$ba->tanggal_indo($ba->tgl_pelaporan, TRUE)}}, <br> Bendaharawan Pembantu Penerimaan</p>
            <br>
            <br>
            <p>{{$ba->name}}<br> NIP {{$ba->nip}}</p>
        </div>
    </div>

</body></html>