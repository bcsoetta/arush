@extends('layouts.app')

@section('pageName')
Rekam Jaminan
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Rekam Jaminan</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('jaminan.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nomor') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">Nomor BPJ</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="nomor" value="{{ old('nomor') }}"  autofocus>

                                @if ($errors->has('nomor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nomor') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
                            <label for="tanggal" class="col-md-4 control-label">Tanggal</label>

                            <div class="col-md-8" id="tgl">
                                <input id="tanggal" type="text" class="form-control" name="tanggal" value="{{ old('tanggal') }}" >

                                @if ($errors->has('tanggal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('penjamin') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">Penjamin</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="penjamin" value="{{ old('penjamin') }}"  autofocus>

                                @if ($errors->has('penjamin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('penjamin') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bentuk_jaminan') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">Bentuk Jaminan</label>

                            <div class="col-md-8">
                                <select class="form-control" name="bentuk_jaminan" id="bentuk">
                                    <option value=""></option>
                                    <option value="TUNAI">TUNAI</option>
                                    <option value="BANK">BANK</option>
                                    <option value="CUSTOMS BOND">CUSTOMS BOND</option>
                                    <option value="LAINNYA">LAINNYA</option>
                                </select>

                                @if ($errors->has('bentuk_jaminan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bentuk_jaminan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
                            <label for="jumlah" class="col-md-4 control-label">Jumlah</label>

                            <div class="col-md-8">
                                <input id="jumlah" type="text" class="form-control" name="jumlah" value="{{ old('jumlah') }}" >

                                @if ($errors->has('jumlah'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                            <label for="jenis" class="col-md-4 control-label">Jenis</label>

                            <div class="col-md-8">
                                <select class="form-control" name="jenis" id="jenis">
                                    <option value=""></option>
                                    <option value="1">SEKALI</option>
                                    <option value="2">TERUS MENERUS</option>
                                </select>

                                @if ($errors->has('jenis'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jenis') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('tanggal_jatuh_tempo') ? ' has-error' : '' }}">
                            <label for="tanggal_jatuh_tempo" class="col-md-4 control-label">Tanggal Jatuh Tempo</label>

                            <div class="col-md-8" id="tempo">
                                <input id="tanggal_jatuh_tempo" type="text" class="form-control" name="tanggal_jatuh_tempo" value="{{ old('tanggal_jatuh_tempo') }}" >

                                @if ($errors->has('tanggal_jatuh_tempo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_jatuh_tempo') }}</strong>
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
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $("#bentuk").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $("#jenis").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $('#tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
     $('#tempo input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection

