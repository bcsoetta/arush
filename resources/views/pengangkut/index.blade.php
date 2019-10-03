@extends('layouts.app')

@section('pageName')
Pengangkut
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"> Pengangkut</h3>
    </div>
    <div class="panel-body">
        <a href="{{route('pengangkut.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">Tambah Pengangkut</button></a>
        <div class="table-responsive">
            <table id="" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Voy</th>
                        <th>Pesawat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengangkut as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->kode}}</td>
                        <td>{{$data->pesawat}}</td>

                        <td style="text-align: center;">
                        <a class="btn btn-xs btn-primary" href="{{route('pengangkut.edit', $data->id)}}">Edit</a>
                        {{-- <a class="btn btn-xs btn-danger" href="#" 
                            onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Hapus</a>
                            <form id="delete-form" action="{{route('permissions.destroy', $data->id)}}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pull-right">{{ $pengangkut->links() }}</div>
    </div>
</div> {{-- end-panel --}}
@endsection