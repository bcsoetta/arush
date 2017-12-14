@extends('layouts.app')

@section('pageName')
Jaminan
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Jaminan</h3>
    </div>
    <div class="panel-body">
        <a href="{{route('jaminan.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">BUAT BPJ </button></a>
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No BPJ</th>
                    <th>Tgl</th>
                    <th>Penjamin</th>
                    <th>Bentuk</th>
                    <th>Jumlah</th>
                    <th>Jenis</th>
                    <th>Jatuh tempo</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jaminan as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->nomor}}</td>
                    <td>{{$data->tanggal}}</td>
                    <td>{{$data->penjamin}}</td>
                    <td>{{$data->bentuk_jaminan}}</td>
                    <td>{{number_format($data->jumlah,2,",",".")}}</td>
                    <td>{{$data->jenis_label}}</td>
                    <td>{{$data->tanggal_jatuh_tempo}}</td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{route('jaminan.show', $data->id)}}">Rekam Dokumen</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> {{-- end-panel --}}
@endsection