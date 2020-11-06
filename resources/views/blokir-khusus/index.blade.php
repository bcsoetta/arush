@extends('layouts.app')

@section('pageName')
Blokir Khusus
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Blokir Khusus</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('blokir-khusus.create')}}"><button class="btn btn-success" style="margin-bottom: 10px">Rekam</button></a>
            </div>
            <div class="col-md-12">
                <table id="users-table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Identitas</th>
                            <th>No Surat</th>
                            <th>Hal</th>
                            <th>Keterangan</th>
                            <th>Blokir</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no= 1
                        @endphp

                        @foreach($blokir as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->no_identitas}}</td>
                            <td>{{$data->nomor_surat}}</td>
                            <td>{{$data->hal}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>{{$data->blokir === 'Y' ? 'ACTIVE': 'TIDAK'}}</td>

                            <td style="text-align: center;">
                                <a class="btn btn-xs btn-primary" href="{{route('blokir-khusus.edit', $data->id)}}">Edit</a>
                                <a class="btn btn-xs btn-danger" href="{{route('blokir-khusus.buka', $data->id)}}">Buka</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $('#users-table').DataTable();
</script>
@endsection