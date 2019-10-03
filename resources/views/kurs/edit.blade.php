@extends('layouts.app')

@section('pageName')
Kurs Edit
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit Kurs</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('kurs.update', $kurs->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Kode</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ $kurs->code }}" autofocus>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                            <label for="label" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="label" type="text" class="form-control" name="label" value="{{ $kurs->label }}">

                                @if ($errors->has('label'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('label') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nilai') ? ' has-error' : '' }}">
                            <label for="nilai" class="col-md-4 control-label">Nilai</label>

                            <div class="col-md-6">
                                <input id="nilai" type="text" class="form-control" name="nilai" value="{{ $kurs->nilai }}">

                                @if ($errors->has('nilai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nilai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('berlaku') ? ' has-error' : '' }}" id="tgl">
                            <label for="berlaku" class="col-md-4 control-label">Berlaku tgl</label>

                            <div class="col-md-6">
                                <input id="berlaku" type="text" class="form-control" name="berlaku" value="{{ $kurs->tgl_awal }}">

                                @if ($errors->has('berlaku'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('berlaku') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sampai') ? ' has-error' : '' }}" id="tgl">
                            <label for="sampai" class="col-md-4 control-label">Sampai tgl</label>

                            <div class="col-md-6">
                                <input id="sampai" type="text" class="form-control" name="sampai" value="{{ $kurs->tgl_akhir }}">

                                @if ($errors->has('sampai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sampai') }}</strong>
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
<script>
    $('#tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection

