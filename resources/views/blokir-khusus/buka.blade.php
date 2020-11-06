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
                <div class="panel-heading">Buka Blokir Perusahaan</div>

                <div class="panel-body">
                    <a href="{{ url()->previous() }}"><button class="btn btn-primary" style="margin: 15px; margin-left: 0px;">Kembali</button></a>

                    <form class="form-horizontal" method="POST" action="{{ route('blokir-khusus.penyelesaian', $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('no_identitas') ? ' has-error' : '' }}">
                            <label for="no_identitas" class="col-md-4 control-label">Nomor Identitas</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="no_identitas" value="{{ $data->no_identitas }}" readonly>

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
                                <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" readonly>

                                @if ($errors->has('nama'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('blokir') ? ' has-error' : '' }}">
                            <label for="blokir" class="col-md-4 control-label">Blokir</label>

                            <div class="col-md-8">
                                <select class="form-control" name="blokir">
                                    <option value="Y" {{$data->blokir === 'Y' ? 'selected': ''}}>ACTIVE</option>
                                    <option value="N" {{$data->blokir === 'N' ? 'selected': ''}}>TIDAK</option>
                                </select>

                                @if ($errors->has('blokir'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('blokir') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('penyelesaian') ? ' has-error' : '' }}">
                            <label for="penyelesaian" class="col-md-4 control-label">Penyelesaian Blokir</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" name="penyelesaian">{{ $data->penyelesaian }}</textarea>

                                @if ($errors->has('penyelesaian'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('penyelesaian') }}</strong>
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