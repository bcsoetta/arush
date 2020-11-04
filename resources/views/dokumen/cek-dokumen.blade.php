@extends('layouts.app')

@section('pageName')
Rekam Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- over view --}}

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Cek Importir dan PPJK</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('dokumen.prosesCekDokumen') }}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <h3>Importir :</h3>
                        <div class="form-group {{ $errors->has('importir_nm') ? ' has-error' : '' }}">
                            <label for="importir_npwp">Nama</label>
                            <input type="text" class="form-control" name="importir_nm" value="{{ old('importir_nm') }}" placeholder="nama" id="importir_nm" autofocus>
                            @if ($errors->has('importir_nm'))
                            <span class="help-block">
                                {{ $errors->first('importir_nm') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('importir_npwp') ? ' has-error' : '' }}">
                            <label for="importir_npwp">NPWP</label>
                            <input type="text" class="form-control" name="importir_npwp" value="{{ old('importir_npwp') }}" placeholder="npwp" id="importir_npwp">
                            @if ($errors->has('importir_npwp'))
                            <span class="help-block">
                                {{ $errors->first('importir_npwp') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('importir_alamat') ? ' has-error' : '' }}">
                            <label for="importir_alamat">Alamat</label>
                            <textarea class="form-control" rows="2" name="importir_alamat" placeholder="alamat" id="importir_alamat">{{ old('importir_alamat') }}</textarea>
                            @if ($errors->has('importir_alamat'))
                            <span class="help-block">
                                {{ $errors->first('importir_alamat') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>PPJK :</h3>
                        <div class="form-group {{ $errors->has('ppjk_nm') ? ' has-error' : '' }}">
                            <label for="ppjk_nm">Nama</label>
                            <input type="text" class="form-control" name="ppjk_nm" value="{{ old('ppjk_nm') }}" placeholder="nama" id="ppjk_nm" autofocus>
                            @if ($errors->has('ppjk_nm'))
                            <span class="help-block">
                                {{ $errors->first('ppjk_nm') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('ppjk_npwp') ? ' has-error' : '' }}">
                            <label for="ppjk_npwp">NPWP</label>
                            <input type="npwp" class="form-control" name="ppjk_npwp" value="{{ old('ppjk_npwp') }}" id="ppjk_npwp" placeholder="npwp">
                            @if ($errors->has('ppjk_npwp'))
                            <span class="help-block">
                                {{ $errors->first('ppjk_npwp') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('ppjk_alamat') ? ' has-error' : '' }}">
                            <label for="ppjk_alamat">Alamat</label>
                            <textarea class="form-control" rows="2" name="ppjk_alamat" placeholder="alamat" id="ppjk_alamat">{{ old('ppjk_alamat') }}</textarea>
                            @if ($errors->has('ppjk_alamat'))
                            <span class="help-block">
                                {{ $errors->first('ppjk_alamat') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-danger main-color-bg pull-right">
                                    Cek
                                </button>
                            </div>
                        </div>
                    </div>
                </form>


                <div style="margin-right: 12px;">
                    <a href="{{ route('dokumen.create')}}"><button class="btn btn-primary pull-right" style='margin-top: 10px;'>Lanjutkan Rekam Dokumen</button></a>
                </div>

            </div>
        </div>
        <hr>
        @if(isset($dokumen) AND count($dokumen) > 0)
        <div class="row">
            <div class="col-md-12">
                <h3>Importir: {{$dokumen[0]['importir_nm']}}</h3>
                <h3>NPWP: {{$dokumen[0]['importir_npwp']}}</h3>
                <h5>Memiliki Dokumen RH yang belum definitif: </h5>
                <h5>* warna merah lebih dari 3 (tiga) hari, tidak dapat dilakukan perekaman dokumen RH</h5>
                <hr>
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor RH</th>
                                <th>Tgl</th>
                                <th>Importir</th>
                                <th>PPJK</th>
                                <th>HAWB</th>
                                <th>Tgl</th>
                                <th>SPPB</th>
                                <th>Tgl</th>
                                <th>Waktu keluar</th>
                                <th>Hari Stlh SPPB</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokumen as $doc)
                            <tr class="{{$doc->selisih_hari > 3 ? 'danger': ''}}">
                                <td style="text-align: center">{{$doc->daftar_no}}</td>
                                <td style="text-align: center">{{$doc->daftar_tgl}}</td>
                                <td>{{$doc->importir_nm}}</td>
                                <td>{{$doc->ppjk_nm}}</td>
                                <td>{{$doc->hawb_no}}</td>
                                <td>{{$doc->hawb_tgl}}</td>
                                <td style="text-align: center">{{$doc->sppb->no_sppb}}</td>
                                <td style="text-align: center">{{$doc->sppb->created_at}}</td>
                                <td>{{$doc->sppb->waktu_keluar}}</td>
                                <td style="text-align: center">{{$doc->selisih_hari}}</td>
                                <td style="text-align: center">
                                    <a class='btn btn-primary btn-xs' href="{{route('dokumen.show', $doc->id)}}">Detail</a>
                                    <a class='btn btn-danger btn-xs' href="{{route('pendok.create', $doc->id)}}">Rekam PIB/PIBK</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        @if(isset($blokir) AND count($blokir) > 0)
        <div class="row">
            <div class="col-md-12">
                <h3>Blokir Khusus :</h3>
                <hr>
                <div class="table-responsive">
                    <table id="users-table" class="table table-condensed table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Identitas</th>
                                <th>No Surat</th>
                                <th>Hal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blokir as $data)
                            <tr>
                                <td>1</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->no_identitas}}</td>
                                <td>{{$data->nomor_surat}}</td>
                                <td>{{$data->hal}}</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>


</div> {{-- end-panel --}}
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('#tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $('#tgl_jaminan input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "top auto",
        autoclose: true,
        todayHighlight: true
    });
    $("#pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $("#angkut").select2({
        placeholder: "Pilih",
        allowClear: true
    });

    $(function() {
        $("#importir_nm").autocomplete({
            source: "{{route('auto.importir')}}",
            minLength: 1,
            autoFocus: true,
            select: function(event, ui) {
                $('#importir_nm').val(ui.item.nama);
                $('#importir_npwp').val(ui.item.npwp);
                $('#importir_alamat').val(ui.item.alamat);
            }
        });
    });

    $(function() {
        $("#ppjk_nm").autocomplete({
            source: "{{route('auto.ppjk')}}",
            minLength: 1,
            autoFocus: true,
            select: function(event, ui) {
                $('#ppjk_nm').val(ui.item.nama);
                $('#ppjk_npwp').val(ui.item.npwp);
                $('#ppjk_alamat').val(ui.item.alamat);
            }
        });
    });
</script>
@endsection