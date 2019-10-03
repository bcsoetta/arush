@extends('layouts.app')

@section('pageName')
Jaminan
@endsection

@section('styles')
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title"><strong>Dokumen Lengkap</strong></h2>
    </div>
    <div class="panel-body">
        @include('partial.panel')
@include('partial.header-dokumen')
        <div class="row">
            
            <div class="col-md-8 col-md-offset-1">
                
                <h3>Detail Jaminan :</h3>

                <table class="table table-condensed table-borderless" style="width: 400px; ">
                    @foreach($jamin as $jaminan)
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
                        <td>{{number_format($jaminan->jumlah,0,",",".")}}</td>
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
                        <td>----</td>
                        <td>----</td>
                        <td>----</td>
                    </tr>
                    @endforeach
                </table>                
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
@endsection