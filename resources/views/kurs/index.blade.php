@extends('layouts.app')

@section('pageName')
Kurs
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Kurs</h3>
    </div>
    <div class="panel-body">
        <a href="{{route('kurs.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">Tambah Kurs</button></a>
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Label</th>
                    <th>Nilai</th>
                    <th>Berlaku</th>
                    <th>Sampai</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kurs as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->code}}</td>
                    <td>{{$data->label}}</td>
                    <td>{{$data->nilai}}</td>
                    <td>{{$data->tgl_awal}}</td>
                    <td>{{$data->tgl_akhir}}</td>

                    <td style="text-align: center;">
                    <a class="btn btn-xs btn-primary" href="{{route('kurs.edit', $data->id)}}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> {{-- end-panel --}}
@endsection