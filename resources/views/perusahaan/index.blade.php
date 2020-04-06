@extends('layouts.app')

@section('pageName')
Perusahaan
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Perusahaan</h3>
    </div>
    <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
            <a href="{{route('perusahaan.create')}}"><button class="btn btn-success" style="margin-bottom: 10px">Rekam</button></a>
        </div>
        <div class="col-md-12">
            <table id="users-table" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Identitas</th>
                        <th>Nomor</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perusahaan as $data)
                    <tr>
                        <td>1</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->jenis_identitas}}</td>
                        <td>{{$data->no_identitas}}</td>
                        <td>{{$data->alamat}}</td>
                        <td>Aktive</td>

                        <td style="text-align: center;">
                            <a class="btn btn-xs btn-primary" href="{{route('perusahaan.edit', $data->id)}}">Edit</a>
                            <a class="btn btn-xs btn-danger" href="#" 
                                onclick="event.preventDefault();
                                document.getElementById('delete-form').submit();">Hapus</a>
                                <form id="delete-form" action="{{route('perusahaan.destroy', $data->id)}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
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

$('#users-table').DataTable({
    order: [ [2, 'desc'] ]
});
</script>
@endsection