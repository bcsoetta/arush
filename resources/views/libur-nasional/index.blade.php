@extends('layouts.app')

@section('pageName')
Libur Nasional
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Libur Nasional</h3>
    </div>
    <div class="panel-body">
        <a href="{{route('libur-nasional.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">Tambah Hari Libur</button></a>
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($liburNasional as $libur)
                <tr>
                    <td>{{$libur->tgl}}</td>
                    <td>{{$libur->label}}</td>

                    <td style="text-align: center;">
                        <a class="btn btn-xs btn-primary" href="{{route('libur-nasional.edit', $libur->id)}}">Edit</a>
                        <a class="btn btn-xs btn-danger" href="#" 
                            onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Hapus</a>
                            <form id="delete-form" action="{{route('libur-nasional.destroy', $libur->id)}}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                    </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> {{-- end-panel --}}
@endsection