@extends('layouts.app')

@section('pageName')
Jaminan
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Jaminan</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5">
                <h3>Detail Jaminan</h3>
                <table class="table table-condensed table-borderless" style="width: 400px">
                    <tr>
                        <th>No BPJ</th>
                        <th>:</th>
                        <td>{{$jaminan->nomor}}</td>
                    </tr>
                    <tr>
                        <th>Tgl</th>
                        <th>:</th>
                        <td>{{$jaminan->tanggal}}</td>
                    </tr>
                    <tr>
                        <th>Penjamin</th>
                        <th>:</th>
                        <td>{{$jaminan->penjamin}}</td>
                    </tr>
                    <tr>
                        <th>Bentuk</th>
                        <th>:</th>
                        <td>{{$jaminan->bentuk_jaminan}}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <th>:</th>
                        <td>{{number_format($jaminan->jumlah,2,",",".")}}</td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <th>:</th>
                        <td>{{$jaminan->jenis_label}}</td>
                    </tr>
                    <tr>
                        <th>Jatuh tempo</th>
                        <th>:</th>
                        <td>{{$jaminan->tanggal_jatuh_tempo}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-7">
                <h3>Tambahkan Dokumen KeJaminan :</h3>
                <hr>
                    <form class="form-horizontal" method="POST" action="{{ route('jaminan.tambah', $jaminan->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('dokumen') ? ' has-error' : '' }}">
                            <label for="dokumen" class="col-md-3 control-label">Dokumen RH</label>

                            <div class="col-md-9">
                                <select class="form-control" name="dokumen" id="dokumen">
                                    <option value=""></option>
                                    @foreach($dokumen as $data)
                                    <option value="{{$data->id}}">No: {{$data->daftar_no}} Importir: {{$data->importir_nm}} PNJ: {{number_format($data->perhitunganJaminan->total,2,",",".")}} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('dokumen'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dokumen') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Tambahkan
                                </button>

                            </div>
                        </div>
                    </form>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Dokumen :</h3>
                <table id="" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No.Daftar</th>
                            <th>Tgl</th>
                            <th>Importir</th>
                            <th>PPJK</th>
                            <th>PNJ</th>
                            <th>Waktu Keluar</th>
                            <th>PIB/PIBK</th>
                            <th>terima</th>
                            <th>beda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jaminan->dokumen as $data)
                        <tr>
                            <td>1</td>
                            <td>{{$data->daftar_no}}</td>
                            <td>{{$data->daftar_tgl}}</td>
                            <td>{{$data->importir_nm}}</td>
                            <td>{{$data->ppjk_nm}}</td>
                            <td style="text-align: right">{{number_format($data->perhitunganJaminan->total,2,",",".")}}</td>
                            @if($data->sppb == null)
                                <td></td>
                            @else
                                <td>{{$data->sppb->waktu_keluar}}</td>
                            @endif
                            
                            @if($data->definitif == null)
                            <td></td>
                            <td></td>
                            @else
                            <td>
                                {{$data->definitif->nomor}} / {{$data->definitif->tanggal}}
                            </td>
                            <td>
                                {{$data->definitif->created_at}}
                            </td>
                            @endif
                            <td>{{ \Carbon\Carbon::createFromFormat('d-m-Y H:s:i', $data->definitif->created_at)->diffForHumans( \Carbon\Carbon::createFromFormat('d-m-Y H:s:i', $data->sppb->waktu_keluar))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> {{-- end-panel --}}
@endsection