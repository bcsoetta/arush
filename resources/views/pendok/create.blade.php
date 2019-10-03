@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Dokumen</div>
            <div class="panel-body">
                <h3>Dokumen :</h3>
                <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No Daftar</th>
                            <th>Importir</th>
                            <th>PPJK</th>
                            <th>MAWB</th>
                            <th>HAWB</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$dokumen->daftar_no}}</td>
                            <td>{{$dokumen->importir_nm}}</td>
                            <td>{{$dokumen->ppjk_nm}}</td>
                            <td>{{$dokumen->mawb_no}}</td>
                            <td>{{$dokumen->hawb_no}}</td>
                            <td style="background-color: yellow">{{$dokumen->status_label}}</td>
                        </tr>
                    </tbody>
                </table>

                <h3>Detail Barang :</h3>
                <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>HS</th>
                            <th>Uraian</th>
                            <th>NA</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailBarang as $barang)
                        <tr>

                            <td>{{$barang->hs_code}}</td>
                            <td>{{$barang->uraian_barang}}</td>
                            <td>{{$barang->negara_asal}}</td>
                            <td>{{$barang->kemasan_jumlah}} {{$barang->kemasan_jenis}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <h3>Rekam PIB /PIBK</h3>
                <form class="form-horizontal" method="POST" action="{{ route('pendok.store', $dokumen->id)}}">
                    {{csrf_field()}}
                    <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                        <label for="user" class="col-md-3 control-label">Jenis Dokumen</label>
                        <div class="col-md-6">
                            <select class="form-control" name="jenis" id="jenis">
                                <option selected></option>
                                <option value="PIB">PIB</option>
                                <option value="PIBK">PIBK</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                            @if ($errors->has('jenis'))
                            <span class="help-block">
                                {{ $errors->first('jenis') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('nomor') ? ' has-error' : '' }}" id="nomor">
                        <label for="user" class="col-md-3 control-label">Nomor PIB/PIBK</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nomor" placeholder="Nomor PIB atau PIBK" autofocus>
                            @if ($errors->has('nomor'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nomor') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}" id="tgl">
                        <label for="user" class="col-md-3 control-label">Tanggal</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="tanggal" placeholder="Tanggal Dokumen">
                            @if ($errors->has('tanggal'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tanggal') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('billing') ? ' has-error' : '' }}" id="billing">
                        <label for="user" class="col-md-3 control-label">No. Billing</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="billing" placeholder="No billing">
                            @if ($errors->has('billing'))
                            <span class="help-block">
                                <strong>{{ $errors->first('billing') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('ntpn') ? ' has-error' : '' }}" id="ntpn">
                        <label for="ntpn" class="col-md-3 control-label">No. NTPN</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="ntpn" placeholder="No. NTPN" >
                            @if ($errors->has('ntpn'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ntpn') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('tgl_ntpn') ? ' has-error' : '' }}" id="tgl">
                        <label for="tgl_ntpn" class="col-md-3 control-label">Tgl. NTPN</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="tgl_ntpn" placeholder="Tanggal NTPN">
                            @if ($errors->has('tgl_ntpn'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tgl_ntpn') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('billing') ? ' has-error' : '' }}" id="total_bayar">
                        <label for="total_bayar" class="col-md-3 control-label">Total Bayar</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="total_bayar" placeholder="Total bayar">
                            @if ($errors->has('billing'))
                            <span class="help-block">
                                <strong>{{ $errors->first('billing') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-danger center-block" onclick="konfirm()">
                                Terima Dokumen
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
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
    $("#jenis").select2({
        placeholder: "Pilih",
        allowClear: true
    });
</script>

@endsection