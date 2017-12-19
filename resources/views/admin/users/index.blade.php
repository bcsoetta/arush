@extends('layouts.app')

@section('pageName')
Users
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Users</h3>
    </div>
    <div class="panel-body">
        <a href="{{route('users.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">tambah User</button></a>
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->nip}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="btn btn-xs btn-primary">{{$role->name}}</span>,
                        @endforeach
                    </td>
                    <td>{{$user->active == 1 ? 'ACTIVE' : 'TIDAK'}}</td>

                    <td style="text-align: center;">
                        <a class="btn btn-xs btn-primary" href="{{route('users.edit', $user->id)}}">Edit</a>
                        {{-- <a class="btn btn-xs btn-danger" href="#" 
                            onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Hapus</a>
                            <form id="delete-form" action="{{route('users.destroy', $user->id)}}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right">{{ $users->links() }}</div>
    </div>
</div> {{-- end-panel --}}
@endsection