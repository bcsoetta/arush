@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> --}}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buat Role</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Role</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                            <label for="label" class="col-md-4 control-label">Keterangan</label>

                            <div class="col-md-6">
                                <input id="label" type="text" class="form-control" name="label">

                                @if ($errors->has('label'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('label') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                            <label for="permissions" class="col-md-4 control-label">Permissions</label>

                            <div class="col-md-6">
                                @foreach($permissions as $permission)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='permission[]' value="{{$permission->id}}">{{$permission->name }} </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>

                                {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> --}}
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
{{-- <script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-dokumen').DataTable();
    } );
 --}}</script>
@endsection

