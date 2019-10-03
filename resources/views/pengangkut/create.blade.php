@extends('layouts.app')

@section('pageName')
Rekam Pengangkut
@endsection

@section('styles')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> --}}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Rekam Pengangkut</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('pengangkut.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('voy') ? ' has-error' : '' }}">
                            <label for="voy" class="col-md-4 control-label">Voy</label>

                            <div class="col-md-6">
                                <input id="voy" type="text" class="form-control" name="voy" value="{{ old('voy') }}" autofocus>

                                @if ($errors->has('voy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('voy') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pesawat') ? ' has-error' : '' }}">
                            <label for="pesawat" class="col-md-4 control-label">Pesawat</label>

                            <div class="col-md-6">
                                <input id="pesawat" type="text" class="form-control" name="pesawat">

                                @if ($errors->has('pesawat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pesawat') }}</strong>
                                    </span>
                                @endif
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
@endsection

