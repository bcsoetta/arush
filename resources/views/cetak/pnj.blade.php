<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<title>Perhitungan Nilai Jaminan</title>
<style>
<!--
 /* Font Definitions */
 @font-face
  {font-family:"Cambria Math";
  panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
  {font-family:Calibri;
  panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
  {margin-top:0in;
  margin-right:0in;
  margin-bottom:10.0pt;
  margin-left:0in;
  line-height:115%;
  font-size:11.0pt;
  font-family:"Calibri",sans-serif;}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
  {margin-top:0in;
  margin-right:0in;
  margin-bottom:10.0pt;
  margin-left:.5in;
  line-height:115%;
  font-size:11.0pt;
  font-family:"Calibri",sans-serif;}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
  {margin-top:0in;
  margin-right:0in;
  margin-bottom:0in;
  margin-left:.5in;
  margin-bottom:.0001pt;
  line-height:115%;
  font-size:11.0pt;
  font-family:"Calibri",sans-serif;}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
  {margin-top:0in;
  margin-right:0in;
  margin-bottom:0in;
  margin-left:.5in;
  margin-bottom:.0001pt;
  line-height:115%;
  font-size:11.0pt;
  font-family:"Calibri",sans-serif;}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
  {margin-top:0in;
  margin-right:0in;
  margin-bottom:10.0pt;
  margin-left:.5in;
  line-height:115%;
  font-size:11.0pt;
  font-family:"Calibri",sans-serif;}
.MsoChpDefault
  {font-family:"Calibri",sans-serif;}
.MsoPapDefault
  {margin-bottom:8.0pt;
  line-height:107%;}
@page WordSection1
  {size:595.3pt 841.9pt;
  margin:1.0in 1.0in 1.0in 1.0in;}
div.WordSection1
  {page:WordSection1;}
 /* List Definitions */
 ol
  {margin-bottom:0in;}
ul
  {margin-bottom:0in;}
-->
</style>

</head>

<body lang=EN-US>

<div class=WordSection1>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;text-autospace:none'><span lang=IN style='font-family:"Arial",sans-serif'>KEMENTERIAN
KEUANGAN REPUBLIK INDONESIA</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;text-autospace:none'><span lang=IN style='font-family:"Arial",sans-serif'>DIREKTORAT
JENDERAL BEA DAN CUKAI</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;text-autospace:none'><span lang=IN style='font-family:"Arial",sans-serif'>KANTOR
PELAYANAN UTAMA TIPE C SOEKARNO HATTA</span></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=676 valign=top style='width:506.9pt;border:none;border-top:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><u><span lang=IN style='font-family:
"Arial",sans-serif'>PERHITUNGAN NILAI JAMINAN</span></u></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><span style='font-family:"Arial",sans-serif'>NOMOR
PENDAFTARAN : {{$dokumen->daftar_no}}    TANGGAL: {{$dokumen->daftar_tgl}}</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 @foreach($perhitungan as $data)
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>FOB</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->harga,1,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>FREIGHT</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->freight,1,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>C &amp; F</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->freight + $data->harga,1,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>INSURANCE</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->asuransi,1,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>CIF</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->cif,1,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>JENIS KURS</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{$dokumen->detail->first()->kurs_label}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>NILAI KURS</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($dokumen->detail->first()->kurs_nilai,2,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>NILAI PABEAN</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->nilai_pabean,2,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>BEA MASUK</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->bm,2,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>DENDA ADM</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>0,00</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>PPN</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->ppn,2,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>PPNBM</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->ppnbm,2,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>PPH</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->pph,2,",",".")}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=126 valign=top style='width:81pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span lang=IN style='font-family:"Arial",sans-serif'>JUMLAH</span></p>
  </td>
  <td width=24 valign=top style='width:.10in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=37 valign=top style='width:20pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  150%'><span style='font-family:"Arial",sans-serif'>Rp.</span></p>
  </td>
  <td width=191 valign=top style='width:90pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:150%'><span style='font-family:"Arial",sans-serif'>{{number_format($data->total,2,",",".")}}</span></p>
  </td>
 </tr>
 @endforeach
</table>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'> </span><span lang=IN
style='font-family:"Arial",sans-serif'>Tangerang, {{$dokumen->perhitunganJaminan->created_at}}</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'> </span><span lang=IN
style='font-family:"Arial",sans-serif'>Mengetahui,</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
lang=IN style='font-family:"Arial",sans-serif'> </span><span lang=IN
style='font-family:"Arial",sans-serif'>Kepala Seksi</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:337.5pt;margin-bottom:.0001pt'><span lang=IN style='font-family:
"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:337.5pt;margin-bottom:.0001pt'><span lang=IN style='font-family:
"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:337.5pt;margin-bottom:.0001pt'><span lang=IN style='font-family:
"Arial",sans-serif'>&nbsp;</span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=0
 style='width:472.5pt;margin-left:-.10pt;border-collapse:collapse;border:none'>
 <tr>
  <td width=54 valign=top style='width:40.2pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
  lang=IN style='font-family:"Arial",sans-serif'>Nama</span></p>
  </td>
  <td width=19 valign=top style='width:13.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
  style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=557 valign=top style='width:418.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
  lang=IN style='font-family:"Arial",sans-serif'>{{$dokumen->perhitunganJaminan->seksi_nama}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=54 valign=top style='width:40.2pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
  lang=IN style='font-family:"Arial",sans-serif'>NIP</span></p>
  </td>
  <td width=19 valign=top style='width:13.9pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
  style='font-family:"Arial",sans-serif'>:</span></p>
  </td>
  <td width=557 valign=top style='width:418.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
  lang=IN style='font-family:"Arial",sans-serif'>{{$dokumen->perhitunganJaminan->seksi_nip}}</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-family:"Arial",sans-serif'>&nbsp;</span></p>

</div>

</body>

</html>
