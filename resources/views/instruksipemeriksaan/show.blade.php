@extends('layouts.app')

@section('pageName')
IP
@endsection

@section('styles')
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title"><strong>Dokumen Lengkap</strong></h2>
    </div>
    <div class="panel-body">
        @include('partial.panel')
        <div class="row">

            <div class="col-md-12">
                @include('partial.header-dokumen')
                <h3>Instruksi Pemeriksaan :</h3>
                <hr>
                <div class="row">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="user" class="col-md-4 control-label">Pemeriksa / NIP</label>

                            <div class="col-md-6">
                                <input id="tingkat_periksa" type="text" class="form-control" name="tingkat_periksa" value="{{ $ip->pemeriksa_nama }} / {{ $ip->pemeriksa_nip }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tingkat_periksa" class="col-md-4 control-label">Tingkat Pemeriksa</label>

                            <div class="col-md-6">
                                <input id="tingkat_periksa" type="text" class="form-control" name="tingkat_periksa" value="{{ $ip->tingkat_periksa }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_kemasan_diperiksa" class="col-md-4 control-label">Jumlah kemasan yang harus diperiksa</label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control" name="jumlah_kemasan_diperiksa" value="{{ $ip->jumlah_kemasan_diperiksa }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor_kontainer_diperiksa" class="col-md-4 control-label">Nomor kontainer yang diperiksa</label>

                            <div class="col-md-6">
                                <input id="nomor_kontainer_diperiksa" type="text" class="form-control" name="nomor_kontainer_diperiksa" value="{{ $ip->nomor_kontainer_diperiksa }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor_kemasan_diperiksa" class="col-md-4 control-label">Nomor kemasan yang diperiksa</label>

                            <div class="col-md-6">
                                <input id="nomor_kemasan_diperiksa" type="text" class="form-control" name="nomor_kemasan_diperiksa" value="{{ $ip->nomor_kemasan_diperiksa }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aju_foto" class="col-md-4 control-label">Ajukan contoh(ya/tidak)</label>

                            <div class="col-md-6">
                                <input id="aju_contoh" type="text" class="form-control" name="aju_contoh" value="{{ $ip->aju_contoh }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aju_foto" class="col-md-4 control-label">Ajukan foto(ya/tidak)</label>

                            <div class="col-md-6">
                                <input id="aju_foto" type="text" class="form-control" name="aju_foto" value="{{ $ip->aju_foto }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aju_foto" class="col-md-4 control-label">Kepala seksi</label>

                            <div class="col-md-6">
                                <input id="aju_foto" type="text" class="form-control" name="aju_foto" value="{{ $ip->seksi_nama }} / {{ $ip->seksi_nip }}">
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