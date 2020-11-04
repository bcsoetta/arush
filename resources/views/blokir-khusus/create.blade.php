@extends('layouts.app')

@section('pageName')
Rekam Perusahaan
@endsection

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Rekam Blokir Perusahaan</div>

                <div class="panel-body">

                    <div class="form-group{{ $errors->has('jenis_identitas') ? ' has-error' : '' }}">
                        <label for="jenis_identitas" class="col-md-4 control-label">Pilih Perusahaan</label>

                        <div class="col-md-8">
                            <select class="form-control pilih" name="jenis_identitas">
                                <option value="" selected>pilih</option>
                                @foreach($perusahaan as $data)
                                <option value="#">{{$data->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <br>
                    <br>
                    <br>

                    <form class="form-horizontal" method="POST" action="{{ route('blokir-khusus.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('no_identitas') ? ' has-error' : '' }}">
                            <label for="no_identitas" class="col-md-4 control-label">Nomor Identitas</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="no_identitas" value="{{ old('no_identitas') }}" autofocus>

                                @if ($errors->has('no_identitas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_identitas') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" autofocus>

                                @if ($errors->has('nama'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nomor_surat') ? ' has-error' : '' }}">
                            <label for="nomor_surat" class="col-md-4 control-label">Nomor Surat</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nomor_surat" value="{{ old('nomor_surat') }}" autofocus>

                                @if ($errors->has('nama'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nomor_surat') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('hal') ? ' has-error' : '' }}">
                            <label for="hal" class="col-md-4 control-label">Hal</label>

                            <div class="col-md-8">
                                <input id="hal" type="text" class="form-control" name="hal" value="{{ old('hal') }}" autofocus>

                                @if ($errors->has('hal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hal') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan / Alasan Blokir</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" name="keterangan">{{ old('keterangan') }}</textarea>

                                @if ($errors->has('keterangan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('keterangan') }}</strong>
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
    $(".pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
</script>
@endsection