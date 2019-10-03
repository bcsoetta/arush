@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Rekam Libur</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('libur-nasional.update', $liburNasional->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('tgl') ? ' has-error' : '' }}">
                            <label for="tgl" class="col-md-4 control-label">Tanggal</label>

                            <div class="col-md-6 tgl">
                                <input id="tgl" type="text" class="form-control" name="tgl" value="{{ $liburNasional->tgl }}">

                                @if ($errors->has('tgl'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                            <label for="label" class="col-md-4 control-label">Keterangan</label>

                            <div class="col-md-6">
                                <input id="label" type="text" class="form-control" name="label" value="{{ $liburNasional->label }}">

                                @if ($errors->has('label'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('label') }}</strong>
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
    $('.tgl input').datepicker({
        format: "yyyy-mm-dd",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection

