@extends('layouts.app')

@section('pageName')
DashBoard
@endsection

@section('styles')

@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Waktu Perimmportir</h3>
    </div>
    <div class="panel-body">
        <table class='table table-bordered'>
            <thead>
                <th>NPWP</th>
                <th>Nama</th>
                <th>Tahun</th>
                <th>Bulan</th>
                <th>Waktu/Jam</th>
            </thead>
            <tbody>
                @foreach($waktu as $wkt)
                    <tr>
                        <td class="text-center">{{$wkt->nama_importir}}</td>
                        <td class="text-center">{{$wkt->npwp_importir}}</td>
                        <td class="text-center">{{$wkt->tahun}}</td>
                        <td>{{$wkt->bulan}}</td>
                        <td class="text-center"><b>{{number_format($wkt->ratarata,2)}}</b></td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        

    </div>
</div>
@endsection

@section('scripts')

@endsection