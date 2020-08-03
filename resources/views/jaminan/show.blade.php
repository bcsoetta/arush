@extends('layouts.app')

@section('pageName')
Jaminan
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Detail Jaminan</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-borderless table-condensed">
                    <tr>
                        <th>No BPJ</th>
                        <th>:</th>
                        <td>{{$jaminan->nomor}}</td>
                    </tr>
                    <tr>
                        <th>Tgl</th>
                        <th>:</th>
                        <td>{{$jaminan->tanggal}}</td>
                    </tr>
                    <tr>
                        <th>No Jaminan</th>
                        <th>:</th>
                        <td>{{$jaminan->nomor_jaminan}}</td>
                    </tr>
                    <tr>
                        <th>Tgl Jaminan</th>
                        <th>:</th>
                        <td>{{$jaminan->tanggal_jaminan}}</td>
                    </tr>
                    <tr>
                        <th>Penjamin</th>
                        <th>:</th>
                        <td>{{$jaminan->penjamin}}</td>
                    </tr>
                    <tr>
                        <th>Bentuk</th>
                        <th>:</th>
                        <td>{{$jaminan->bentuk_jaminan}}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <th>:</th>
                        <td>{{number_format($jaminan->jumlah,0,',','.')}}</td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <th>:</th>
                        <td>{{$jaminan->jenis_label}}</td>
                    </tr>
                    <tr>
                        <th>Jatuh tempo</th>
                        <th>:</th>
                        <td>{{$jaminan->tanggal_jatuh_tempo}}</td>
                    </tr>
                    <tr>
                        <th>Sisa Saldo</th>
                        <th>:</th>
                        <td>{{number_format($jaminan->saldo,0,',','.')}}</td>
                    </tr>
                    <tr>
                        <th>Perekam</th>
                        <th>:</th>
                        <td>{{$jaminan->user->name}}</td>
                    </tr>
                    <tr>
                        <th>STATUS</th>
                        <th>:</th>
                        <td>{{$jaminan->status}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Dokumen :</h3>
                <table id="" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No.Daftar</th>
                            <th>Tgl</th>
                            <th>Importir</th>
                            <th>PPJK</th>
                            <th>SPPB</th>
                            <th>Tgl</th>
                            <th>PERKIRAAN</th>
                            <th>NO. Billing</th>
                            <th>NTPN</th>
                            <th>Tgl.NTPN</th>
                            <th>TOTAL</th>
                            <th>PIB</th>
                            <th>Tgl</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jaminan->dokumen as $data)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td class="text-center">{{$data->daftar_no}}</td>
                            <td class="text-center">{{tgl_indo($data->daftar_tgl)}}</td>
                            <td>{{$data->importir_nm}}</td>
                            <td>{{$data->ppjk_nm}}</td>                            
                            <td class="text-center">{{$data->sppb ? $data->sppb->no_sppb : '' }}</td>
                            <td class="text-center">{{$data->sppb ? tgl_indo($data->sppb->created_at) : '' }}</td>
                            <td class="text-right">{{number_format($data->detail->sum('bayar_total'),0,',','.')}}</td>
                            <td class="text-center">{{$data->definitif ? $data->definitif->billing : '' }}</td>
                            <td class="text-center">{{$data->definitif ? $data->definitif->ntpn : '' }}</td>
                            <td class="text-center">{{$data->definitif ? $data->definitif->tgl_ntpn : '' }}</td>
                            <td class="text-center">{{$data->definitif ? number_format($data->definitif->total_bayar,0,',','.') : '' }}</td>
                            <td class="text-center">{{$data->definitif ? $data->definitif->nomor : '' }}</td>
                            <td class="text-center">{{$data->definitif ? $data->definitif->tanggal : '' }}</td>
                            <td class="text-center">{{$data->status_label}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> {{-- end-panel --}}
@endsection