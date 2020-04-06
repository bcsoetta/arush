@extends('layouts.app')

@section('pageName')
Edit Perusahaan
@endsection

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit Perusahaan</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('perusahaan.update', $perusahaan->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-8">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $perusahaan->nama }}"  autofocus>

                                @if ($errors->has('nama'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" name="alamat">{{ $perusahaan->alamat }}</textarea>

                                @if ($errors->has('alamat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jenis_identitas') ? ' has-error' : '' }}">
                            <label for="jenis_identitas" class="col-md-4 control-label">Jenis Identitas</label>

                            <div class="col-md-8">
                                <select class="form-control" id="pilih" name="jenis_identitas">
                                    
                                    @foreach ($jenis_identitas as $item)
                                    <option value="{{$item->uraian}}" {{$item->uraian == $perusahaan->jenis_identitas ? "selected": ""}}>{{$item->uraian}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('jenis_identitas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jenis_identitas') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('no_identitas') ? ' has-error' : '' }}">
                            <label for="no_identitas" class="col-md-4 control-label">Nomor Identitas</label>

                            <div class="col-md-8">
                                <input id="no_identitas" type="text" class="form-control" name="no_identitas" value="{{ $perusahaan->no_identitas }}" >

                                @if ($errors->has('no_identitas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_identitas') }}</strong>
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
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $("#pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
</script>
@endsection

