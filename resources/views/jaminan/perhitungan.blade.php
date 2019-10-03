@extends('layouts.app')

@section('pageName')
Pemeriksa
@endsection

@section('styles')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> --}}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Perhitungan Nilai Jaminan</div>
                <div class="panel-body" style="text-align: center">
                    <h3>Perhitungan Nilai Jaminan</h3>
                    <p>Nomor Pendaftaran : {{$dokumen->daftar_no}}&nbsp;&nbsp;&nbsp;Tanggal : {{$dokumen->daftar_tgl}}</p>
                    <div class="table-responsive col-md-6 col-md-offset-3">
                        <hr>
                        <table class="table table-condensed">
                            <thead>
                            </thead>
                            <tbody>
                                @foreach($perhitungan as $data)
                                <tr>
                                    <th>FOB</th>
                                    <th>:</th>
                                    <th></th>
                                    <th style="text-align: right">{{number_format($data->harga,1,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>FREIGHT</th>
                                    <th>:</th>
                                    <th></th>
                                    <th style="text-align: right">{{number_format($data->freight,1,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>C &amp; F</th>
                                    <th>:</th>
                                    <th></th>
                                    <th style="text-align: right">{{number_format($data->freight + $data->harga,1,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>INSURANCE</th>
                                    <th>:</th>
                                    <th></th>
                                    <th style="text-align: right">{{number_format($data->asuransi,1,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>CIF</th>
                                    <th>:</th>
                                    <th></th>
                                    <th style="text-align: right">{{number_format($data->cif,1,",",".")}}</th>
                                </tr>
                                 <tr>
                                    <th>JENIS KURS</th>
                                    <th>:</th>
                                    <th></th>
                                    <th>{{$dokumen->detail->first()->kurs_label}}</th>
                                </tr>
                                <tr>
                                    <th>NILAI KURS</th>
                                    <th>:</th>
                                    <th>Rp.&nbsp;</th>
                                    <th style="text-align: right">{{number_format($dokumen->detail->first()->kurs_nilai,2,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>NILAI PABEAN</th>
                                    <th>:</th>
                                    <th>Rp.&nbsp;</th>
                                    <th style="text-align: right">{{number_format($data->nilai_pabean,2,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <tr>
                                    <th>BEA MASUK</th>
                                    <th>:</th>
                                    <th>Rp.&nbsp;</th>
                                    <th style="text-align: right">{{number_format($data->bm,2,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <th>:</th>
                                    <th>Rp.&nbsp;</th>
                                    <th style="text-align: right">{{number_format($data->ppn,2,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>PPnBM</th>
                                    <th>:</th>
                                    <th>Rp.&nbsp;</th>
                                    <th style="text-align: right">{{number_format($data->ppnbm,2,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>PPH</th>
                                    <th>:</th>
                                    <th>Rp.&nbsp;</th>
                                    <th style="text-align: right">{{number_format($data->pph,2,",",".")}}</th>
                                </tr>
                                <tr>
                                    <th>JUMLAH</th>
                                    <th>:</th>
                                    <th>Rp.&nbsp;</th>
                                    <th style="text-align: right; background-color: yellow">{{number_format($data->total,2,",",".")}}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$dokumen->perhitunganJaminan)
                        <a href="" class="btn btn-primary btn-block" onclick="event.preventDefault();document.getElementById('simpan').submit();">SIMPAN</a>
                            <form id="simpan" action="{{ route('jaminan.hitung.simpan', $dokumen->id) }}" method="POST" style="display: none;">
                                {{csrf_field()}}
                        </form>

                        @elseif($dokumen->perhitunganJaminan->total == $perhitungan->first()->total)
                        <a href="" class="btn btn-primary btn-block" onclick="event.preventDefault();document.getElementById('cetak').submit();">CETAK</a>
                        <form id="cetak" action="{{ route('cetak.pnj', $dokumen->id) }}" method="GET" style="display: none;">
                        </form>
                        <br>
                        @else
                        <a href="" class="btn btn-primary btn-block" onclick="event.preventDefault();document.getElementById('simpan').submit();">SIMPAN</a>
                            <form id="simpan" action="{{ route('jaminan.hitung.simpan', $dokumen->id) }}" method="POST" style="display: none;">
                                {{csrf_field()}}
                        </form>
                        <br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection

