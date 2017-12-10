@extends('layouts.app')

@section('pageName')
home
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Roles</h3>
    </div>
    <div class="panel-body">
        <a href="{{route('roles.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">tambah role</button></a>
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->label}}</td>

                    <td style="text-align: center;">
                        <a class="btn btn-xs btn-primary" href="{{route('roles.edit', $role->id)}}">Edit</a>
{{--                         <a class="btn btn-xs btn-danger" href="#" 
                            onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Hapus</a>
                            <form id="delete-form" action="{{route('roles.destroy', $role->id)}}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> {{-- end-panel --}}
@endsection