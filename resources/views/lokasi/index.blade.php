@extends('layouts.app')

@section('pageName')
Lokasi
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lokasi</h3>
    </div>
    <div class="panel-body">
        <a href="{{route('lokasi.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">Tambah Lokasi</button></a>
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Active</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($lokasi as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->kode}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->active}}</td>

                    <td style="text-align: center;">
                    <a class="btn btn-xs btn-primary" href="{{route('lokasi.edit', $data->id)}}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> {{-- end-panel --}}
@endsection