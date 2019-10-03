@extends('layouts.app')

@section('pageName')
Users
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Users</h3>
    </div>
    <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
            <a href="{{route('users.create')}}"><button class="btn btn-primary" style="margin-bottom: 10px">Tambah User</button></a>
        </div>
        <div class="col-md-12">
            <table id="users-table" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
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
                        <td>{{$user->name}}</td>
                        <td>{{$user->nip}}</td>
                        <td>{{$user->user_name}}</td>
                        <td>
                            @foreach($user->roles as $role)
                                {{$role->name}}<br>
                            @endforeach
                        </td>
                        <td>{{$user->active == 1 ? 'ACTIVE' : 'TIDAK'}}</td>

                        <td style="text-align: center;">
                        @can('ROLE')
                            <a class="btn btn-xs btn-primary" href="{{route('users.edit', $user->id)}}">Edit</a>
                        @endcan
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