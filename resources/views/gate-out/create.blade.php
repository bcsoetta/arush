@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')

@endsection

@section('content')

@if(count($dokumen) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
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
                            <th>Setatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background-color: yellow">{{$dokumen->daftar_no}}</td>
                            <td>{{$dokumen->importir_nm}}</td>
                            <td>{{$dokumen->ppjk_nm}}</td>
                            <td>{{$dokumen->mawb_no}}</td>
                            <td>{{$dokumen->hawb_no}}</td>
                            <td>{{$dokumen->status_label}}</td>
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
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailBarang as $barang)
                        <tr>

                            <td>{{$barang->hs_code}}</td>
                            <td>{{$barang->uraian_barang}}</td>
                            <td>{{$barang->negara_asal}}</td>
                            <td>{{$barang->kemasan_jumlah}}</td>
                            <td>{{$barang->kemasan_jenis}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <h3>Rekam Barang Keluar</h3>
                <form class="form-horizontal" method="POST" action="{{ route('gateout.store', $dokumen->id)}}">
                    {{csrf_field()}}
                    <div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}" id="catatan">
                        <label for="user" class="col-md-2 control-label">Catatan Pengeluaran</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="catatan" placeholder="keterangan">
                            @if ($errors->has('catatan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('catatan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-danger center-block">
                                Rekam Pengeluaran Barang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dokumen</div>
            <div class="panel-body">
                <p>Tidak ketemu</p>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
@endsection