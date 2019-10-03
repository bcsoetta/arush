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
            <div class="panel panel-primary">
                <div class="panel-heading">Edit Jaminan</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('jaminan.update', $jaminan->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nomor') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">Nomor BPJ</label>

                            <div class="col-md-8" style="padding-top: 8px;">
                                <p>{{$jaminan->nomor}}</p>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
                            <label for="tanggal" class="col-md-4 control-label">Tanggal</label>

                            <div class="col-md-8" id="tgl" style="padding-top: 8px;">
                                <p>{{$jaminan->tanggal}}</p>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('penjamin') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="penjamin" value="{{ $jaminan->penjamin }}"  autofocus>

                                @if ($errors->has('penjamin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('penjamin') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('npwp') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">NPWP</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="npwp" value="{{ $jaminan->npwp }}"  autofocus>

                                @if ($errors->has('npwp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('npwp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="alamat" value="{{ $jaminan->alamat }}"  autofocus>

                                @if ($errors->has('alamat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nomor_jaminan') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">No Jaminan</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="nomor_jaminan" value="{{ $jaminan->nomor_jaminan }}"  autofocus>

                                @if ($errors->has('nomor_jaminan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nomor_jaminan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal_jaminan') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">Tgl No Jaminan</label>

                            <div class="col-md-8 tgl">
                                <input id="name" type="text" class="form-control" name="tanggal_jaminan" value="{{ $jaminan->tanggal_jaminan }}"  autofocus>

                                @if ($errors->has('tanggal_jaminan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_jaminan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bentuk_jaminan') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">Bentuk Jaminan</label>

                            <div class="col-md-8">
                                <select class="form-control" name="bentuk_jaminan" id="bentuk">
                                    <option value="TUNAI" {{$jaminan->bentuk_jaminan == 'TUNAI'? 'selected': ''}}>TUNAI</option>
                                    <option value="BANK" {{$jaminan->bentuk_jaminan == 'BANK'? 'selected': ''}}>BANK</option>
                                    <option value="CUSTOMS BOND" {{$jaminan->bentuk_jaminan == 'CUSTOMS BOND'? 'selected': ''}}>CUSTOMS BOND</option>
                                    <option value="LAINNYA" {{$jaminan->bentuk_jaminan == 'LAINNYA'? 'selected': ''}}>LAINNYA</option>
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
                                <input id="jumlah" type="text" class="form-control" name="jumlah" value="{{ $jaminan->jumlah }}" >

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
                                    <option value="1" {{$jaminan->jenis_id == '1'? 'selected': ''}}>SEKALI</option>
                                    <option value="2" {{$jaminan->jenis_id == '2'? 'selected': ''}}>TERUS MENERUS</option>
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

                            <div class="col-md-8 tgl">
                                <input id="tanggal_jatuh_tempo" type="text" class="form-control" name="tanggal_jatuh_tempo" value="{{$jaminan->tanggal_jatuh_tempo}}" >

                                @if ($errors->has('tanggal_jatuh_tempo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_jatuh_tempo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('no_bukti_pengembalian') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">No Bukti Pengembalian</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="no_bukti_pengembalian" value="{{ $jaminan->no_bukti_pengembalian }}" >

                                @if ($errors->has('no_bukti_pengembalian'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_bukti_pengembalian') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tgl_bukti_pengembalian') ? ' has-error' : '' }}">
                            <label for="tgl_bukti_pengembalian" class="col-md-4 control-label">Tgl Bukti Pengembalian</label>

                            <div class="col-md-8 tgl">
                                <input id="tgl_bukti_pengembalian" type="text" class="form-control" name="tgl_bukti_pengembalian" value="{{$jaminan->tgl_bukti_pengembalian}}" >

                                @if ($errors->has('tgl_bukti_pengembalian'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tgl_bukti_pengembalian') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kode_agenda') ? ' has-error' : '' }}">
                            <label for="nomor" class="col-md-4 control-label">Kode Agenda</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="kode_agenda" value="{{ $jaminan->kode_agenda }}" >

                                @if ($errors->has('kode_agenda'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_agenda') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="jenis" class="col-md-4 control-label">Status</label>

                            <div class="col-md-8">
                                <select class="form-control" name="status" id="jenis">
                                    <option value="AKTIF" {{$jaminan->status == 'AKTIF'? 'selected': ''}}>AKTIF</option>
                                    <option value="DICAIRKAN" {{$jaminan->status == 'DICAIRKAN'? 'selected': ''}}>DICAIRKAN</option>
                                    <option value="BATAL" {{$jaminan->status == 'BATAL'? 'selected': ''}}>BATAL</option>
                                </select>

                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
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
    $('.tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection

