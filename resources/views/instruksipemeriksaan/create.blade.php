@extends('layouts.app')

@section('pageName')
Rekam IP
@endsection

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title"><strong>Dokumen Lengkap</strong></h2>
    </div>
    <div class="panel-body">
        @include('partial.panel')
        <div class="row">
            <div class="col-md-12">

                @include('partial.header-dokumen')
                <h3>Rekam Instruksi Pemeriksaan (IP) :</h3>
                
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                        <form class="form-horizontal" method="POST" action="{{ route('instruksi-pemeriksaan.store', $dokumen->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('pemeriksa') ? ' has-error' : '' }}">
                                <label for="user" class="col-md-4 control-label">Nama Pemeriksa</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="pemeriksa" id="pilih" autofocus>
                                        <option></option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} {{$user->nip}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pemeriksa'))
                                    <span class="help-block">
                                        {{ $errors->first('pemeriksa') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tingkat_periksa') ? ' has-error' : '' }}">
                                <label for="tingkat_periksa" class="col-md-4 control-label">Tingkat Pemeriksa</label>

                                <div class="col-md-6">
                                    <input id="tingkat_periksa" type="text" class="form-control" name="tingkat_periksa" value="{{ old('tingkat_periksa') ? old('tingkat_periksa') : '100%'  }}">

                                    @if ($errors->has('tingkat_periksa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tingkat_periksa') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- <div class="form-group{{ $errors->has('jumlah_kemasan_diperiksa') ? ' has-error' : '' }}">
                                <label for="jumlah_kemasan_diperiksa" class="col-md-4 control-label">Jumlah kemasan yang harus diperiksa</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control" name="jumlah_kemasan_diperiksa" value="{{ old('jumlah_kemasan_diperiksa') }}">

                                    @if ($errors->has('jumlah_kemasan_diperiksa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_kemasan_diperiksa') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nomor_kontainer_diperiksa') ? ' has-error' : '' }}">
                                <label for="nomor_kontainer_diperiksa" class="col-md-4 control-label">Nomor kontainer yang diperiksa</label>

                                <div class="col-md-6">
                                    <input id="nomor_kontainer_diperiksa" type="text" class="form-control" name="nomor_kontainer_diperiksa" value="{{ old('nomor_kontainer_diperiksa') }}">

                                    @if ($errors->has('nomor_kontainer_diperiksa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nomor_kontainer_diperiksa') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nomor_kemasan_diperiksa') ? ' has-error' : '' }}">
                                <label for="nomor_kemasan_diperiksa" class="col-md-4 control-label">Nomor kemasan yang diperiksa</label>

                                <div class="col-md-6">
                                    <input id="nomor_kemasan_diperiksa" type="text" class="form-control" name="nomor_kemasan_diperiksa" value="{{ old('nomor_kemasan_diperiksa') }}">

                                    @if ($errors->has('nomor_kemasan_diperiksa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nomor_kemasan_diperiksa') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> -->

                            <div class="form-group{{ $errors->has('aju_contoh') ? ' has-error' : '' }}">
                                <label for="aju_foto" class="col-md-4 control-label">Ajukan contoh(ya/tidak)</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="aju_contoh" id="aju_contoh">
                                        <option value=""></option>
                                        <option value="YA"> YA</option>
                                        <option value="TIDAK"> TIDAK</option>
                                    </select>

                                    @if ($errors->has('aju_contoh'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aju_contoh') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('aju_foto') ? ' has-error' : '' }}">
                                <label for="aju_foto" class="col-md-4 control-label">Ajukan foto(ya/tidak)</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="aju_foto" id="aju_foto">
                                        <option value=""></option>
                                        <option value="YA"> YA</option>
                                        <option value="TIDAK"> TIDAK</option>
                                    </select>

                                    @if ($errors->has('aju_foto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aju_foto') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-8">
                                    <button type="submit" class="btn btn-primary" onclick="konfirm()">
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
</div> {{-- end-panel --}}

@endsection

@section('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $("#pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $("#aju_contoh").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $("#aju_foto").select2({
        placeholder: "Pilih",
        allowClear: true
    });
</script>

@endsection