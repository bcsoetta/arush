@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit User</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"  autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
                            <label for="nip" class="col-md-4 control-label">NIP</label>

                            <div class="col-md-8">
                                <input id="nip" type="text" class="form-control" name="nip" value="{{ $user->nip }}" >

                                @if ($errors->has('nip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nip') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-8">
                                <input id="user_name" type="text" class="form-control" name="user_name" value="{{ $user->user_name }}" >

                                @if ($errors->has('user_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" >

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                            <label for="lokasi" class="col-md-4 control-label">lokasi</label>

                            <div class="col-md-8">
                                <select class="form-control" name="lokasi" id="pilih">
                                <option value="" selected></option>
                                            
                                    @foreach($lokasi as $tempat)
                                    <option value="{{$tempat->id}}" {{$tempat->id == $user->lokasi_id ? 'selected' : '' }}>{{$tempat->nama}}</option>
                                    @endforeach

                                </select>
                                <span>lokasi gudang, untuk pegawai staff dan seksi lokasi Kantor</span>

                                @if ($errors->has('lokasi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lokasi') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            <label for="roles" class="col-md-4 control-label">Roles</label>

                            <div class="col-md-6">
                                @foreach($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='role[]' value="{{$role->name}}"
                                        @if(count($user->roles->where('id', $role->id)) )
                                         checked="checked"
                                        @endif >{{$role->name }}

                                    </label>
                                        
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $("#pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
</script>
@endsection

