@extends('layouts.app')

@section('pageName')
Absensi
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Absensi</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Role</th>
                        <th>Bertugas</th>
                        <th>ACt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->nip}}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="btn btn-xs btn-primary">{{$role->name}}</span>,
                            @endforeach
                        </td>
                        <td style="text-align: center">
                            @if($user->hadir == 1)
                            <span class="btn btn-xs btn-primary">Hadir</span>
                            @else
                            <span class="btn btn-xs btn-danger">Tidak</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a class="btn btn-xs btn-danger" href="#" 
                                onclick="event.preventDefault();
                                document.getElementById('update-form-{{$user->id}}').submit();">Edit</a>
                                <form id="update-form-{{$user->id}}" action="{{route('absensi.ubah', $user->id)}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pull-right">{{ $users->links() }}</div>
        </div>
    </div>
</div> {{-- end-panel --}}
@endsection