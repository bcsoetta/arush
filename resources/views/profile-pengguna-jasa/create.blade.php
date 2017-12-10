@extends('layouts.app')

@section('pageName')
Rekam Profile
@endsection

@section('styles')

@endsection

@section('content')

        <section id="main" style="">
            <div class="container ">
                <div class="row ">

                    <div class="col-md-8 col-md-offset-2">
                        <!-- overview -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Rekam Profile</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="{{ route('profiles.store') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('nama_perusahaan') ? ' has-error' : '' }}">
                                        <label for="nama_perusahaan" class="col-md-4 control-label">Nama Perusahaan</label>

                                        <div class="col-md-8">
                                            <input id="nama_perusahaan" type="text" class="form-control" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" autofocus>

                                            @if ($errors->has('nama_perusahaan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_perusahaan') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('alamat_perusahaan') ? ' has-error' : '' }}">
                                        <label for="nik" class="col-md-4 control-label">Alamat</label>

                                        <div class="col-md-8">

                                            <textarea name="alamat_perusahaan" class="form-control" cols="3"></textarea>

                                            @if ($errors->has('alamat_perusahaan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alamat_perusahaan') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('npwp') ? ' has-error' : '' }}">
                                        <label for="npwp" class="col-md-4 control-label">NPWP</label>

                                        <div class="col-md-8">
                                            <input id="npwp" type="text" class="form-control" name="npwp" value="{{ old('npwp') }}">

                                            @if ($errors->has('npwp'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('npwp') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                        <label for="nik" class="col-md-4 control-label">NIK</label>

                                        <div class="col-md-8">
                                            <input id="nik" type="text" class="form-control" name="nik" value="{{ old('nik') }}">

                                            @if ($errors->has('nik'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nik') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('api') ? ' has-error' : '' }}">
                                        <label for="api" class="col-md-4 control-label">API</label>

                                        <div class="col-md-8">
                                            <input id="api" type="text" class="form-control" name="api" value="{{ old('api') }}">

                                            @if ($errors->has('api'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('api') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')

@endsection