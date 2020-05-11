@extends('layouts.app')

@section('pageName')
Dokumen Lengkap
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
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
                {{-- parsial --}}
                @include('partial.header-dokumen')
                <h2>Dokumen : {{-- {{$dokumen->definitif() ? $dokumen->definitif->jenis." ".$dokumen->definitif->nomor." TGL:".$dokumen->definitif->tanggal : " "   }} --}} 
                @can('EDIT-DOKUMEN')
                @if($dokumen->status_id <= 4)
                <a href="{{ route('dokumen.edit', $dokumen->id)}}"><button class="btn btn-danger" style="margin: 10px">Edit</button></a>
                @endif
                @endcan
                @can('HAPUS-DOKUMEN')
                @if($dokumen->status_id < 5)
                <button class="btn btn-danger" style="margin: 10px" data-toggle="modal" data-target="#pembatalan">Pembatalan Dokumen</button>
                @endif
                @endcan

                </h2>
                @if($dokumen->status_id == 8)
                <div class="well well-lg">
                    <h3>DOKUMEN DIBATALKAN</h3>
                    <p>Karena: {{$dokumen->keterangan_pembatalan}}</p>
                </div>
                @endif
                 <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Nomor RH</th>
                        <td>:</td>
                        <th style="background-color: #A8EB12">{{$dokumen->daftar_no}}</th>
                        <th colspan="3">Tanggal : {{tgl_indo($dokumen->daftar_tgl)}}</th>
                    </tr>
                    <tr>
                        <th colspan="6"><h4>Importir</h4></th>
                    </tr>
                    <tr>
                        <th>NPWP</th>
                        <td>:</td>
                        <td colspan="5" class='npwp'>{{$dokumen->importir_npwp}}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td colspan="5">{{$dokumen->importir_nm}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td colspan="5"><p>{{$dokumen->importir_alamat}}</p></td>
                    </tr>
                    <tr>
                        <th colspan="6"><h4>PPJK</h4></th>
                    </tr>
                    <tr>
                        <th>NPWP</th>
                        <td>:</td>
                        <td colspan="5" class="npwp">{{$dokumen->ppjk_npwp}}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td colspan="5">{{$dokumen->ppjk_nm}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td colspan="5"><p>{{$dokumen->ppjk_alamat}}</p></td>
                    </tr>

                    <tr>
                        <th colspan="6"><h3>Manifest</h3></th>
                    </tr>
                    <tr>
                        <th>MAWB</th>
                        <td>:</td>
                        <td class="mawb">{{$dokumen->mawb_no}}</td>
                        <td colspan="3">Tanggal : {{$dokumen->mawb_tgl}}</td>
                    </tr>
                    <tr>
                        <th>HAWB</th>
                        <td>:</td>
                        <td>{{$dokumen->hawb_no}}</td>
                        <td colspan="3">Tanggal : {{$dokumen->hawb_tgl}}</td>
                    </tr>
                    <tr>
                        <th>Kemasan</th>
                        <td>:</td>
                        <td colspan="4">{{$dokumen->kmsn_jmlh}} {{$dokumen->kmsn_jenis}}</td>
                    </tr>
                    <tr>
                        <th>Sarana Angkut</th>
                        <td>:</td>
                        <td colspan="4">{{$dokumen->pengangkut_kode}} , {{$dokumen->pengangkut_nama}}</td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td>:</td>
                        <td colspan="4">{{$dokumen->lokasi_label}}</td>
                    </tr>
                    <tr>
                        <th colspan="6"><h3>Fasilitas</h3></th>
                    </tr>
                    <tr>
                        <th>Nomor</th>
                        <td>:</td>
                        <td>{{$dokumen->no_fasilitas}}</td>
                        <td>Tanggal : {{$dokumen->tgl_fasilitas}}</td>
                        <td colspan="2">Ket : {{$dokumen->ket_fasilitas}}</td>
                    </tr>
                </table>
                </div>
                <h2>Dokumen Pelengkap:
                
                    @if($dokumen->status_id < 5)
                    <button class="btn btn-danger" style="margin: 10px" data-toggle="modal" data-target="#dokumenPelengkap">Tambah Dokumen Pelengkap</button>
                    @endif
                
                </h2>
                <div class="table-responsive">
                <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr class="info">
                            <th>No</th>
                            <th>Nama Dok</th>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>File</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($dokumen->dokumenPelengkap as $dokap)
                        <tr>
                            <td style="text-align: center">{{$i++}}</td>
                            <td style="text-align: center">{{$dokap->nama}}</td>
                            <td style="text-align: center">{{$dokap->nomor}}</td>
                            <td style="text-align: center">{{$dokap->tgl}}</td>
                            <td style="text-align: center">{{!empty($dokap->file) ? 'Ada' : 'Tidak Ada'}}</td>
                            <td class="text-center">
                                @if(!empty($dokap->file))
                                <a class="btn btn-primary btn-xs" href="{{route('dokumen-pelengkap.show', $dokap->id)}}" target="_blank">Show</a>
                                    @can('EDIT-DETAIL')
                                    @if($dokumen->status_id < 4)
                                    <!-- <a class="btn btn-danger btn-xs" href="">Edit</a> -->
                                    @endif
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>

                <h2>Detail Barang:
                
                    @can('CREATE-DETAIL')
                    @if($dokumen->status_id > 1 AND auth()->user()->hasRole('PENGGUNA-JASA'))
                    @else
                        @if($dokumen->status_id <= 4)
                        <a href="{{route('detail.create', $dokumen->id)}}"><button class="btn btn-danger" style="margin: 10px">Tambah Detail Barang</button></a>
                        @endif
                    @endif
                    @endcan
                
                </h2>
                <div class="table-responsive">
                <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr class="info">
                            <th>No</th>
                            <th>Hs Code</th>
                            <th>Uraian</th>
                            <th>Jumlah</th>
                            <th>CIF</th>
                            <th colspan="2">Kurs</th>
                            <th>Nilai Pabean (Rp.)</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($dokumen->detail as $detail)
                        <tr>
                            <td style="text-align: center">{{$i++}}</td>
                            <td style="text-align: center">{{$detail->hs_code}}</td>
                            <td >{{$detail->uraian_barang}}</td>
                            <td style="text-align: center">{{$detail->kemasan_jumlah}} {{$detail->kemasan_jenis}}</td>
                            <td class="text-right">{{number_format($detail->cif,2,',','.')}}</td>
                            <td class="text-right">{{$detail->kurs_label}}</td>
                            <td class="text-right">{{number_format($detail->kurs_nilai,2,',','.')}}</td>
                            <td class="text-right">{{number_format($detail->nilai_pabean,2,',','.')}}</td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-xs" href="{{ route('detail.show', $detail->id)}}">Show</a>
                                @can('EDIT-DETAIL')
                                @if($dokumen->status_id < 4)
                                <a class="btn btn-danger btn-xs" href="{{ route('detail.edit', $detail->id)}}">Edit</a>
                                @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <h2>Perhitungan:</h2>
                <div class="table-responsive tarif">
                        <table class="table table-hover table-striped table-highlight">
                            <thead></thead>
                            <tbody>
                                <tr  class="info">
                                    <th></th>
                                    <th>DIBAYAR (Rp)</th>
                                    <th>DITANGGUNG PEMERINTAH (Rp)</th>
                                    <th>DITANGGUHKAN (Rp)</th>
                                    <th>DIBEBASKAN (Rp)</th>
                                </tr>
                                <tr>
                                    <th>BM</th>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('bayar_bm'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditanggung_pmrnth_bm'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditangguhkan_bm'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('dibebaskan_bm'),0,',','.')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('bayar_ppn'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditanggung_pmrnth_ppn'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditangguhkan_ppn'),0,',','.')}}
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('dibebaskan_ppn'),0,',','.')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPNBM</th>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('bayar_ppnbm'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditanggung_pmrnth_ppnbm'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditangguhkan_ppnbm'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('dibebaskan_ppnbm'),0,',','.')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPH</th>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('bayar_pph'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditanggung_pmrnth_pph'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditangguhkan_pph'),0,',','.')}}
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('dibebaskan_pph'),0,',','.')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('bayar_total'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditanggung_pmrnth_total'),0,',','.')}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('ditangguhkan_total'),0,',','.')}}
                                    <td class="text-right">
                                        {{number_format($dokumen->detail->sum('dibebaskan_total'),0,',','.')}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>

                <h2>Jaminan (BPJ): 
                @if($dokumen->status_id <= 4)

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#jaminan">
                Rekam BPJ
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jaminanTerusMenerus">
                BPJ Sebelumnya
                </button>
                @endif
                </h2>
                <div class="table-responsive">
                    <table class="table">
                        <tr  class="info">
                            <th>No BPJ</th>
                            <th>Tgl</th>
                            <th style="width: 300px;">Penjamin</th>
                            <th>Bentuk</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Jatuh tempo</th>
                            <th>Status</th>
                            <th>Ket</th>
                        </tr>
                        @if(count($dokumen->jaminan) > 0)
                        @foreach($dokumen->jaminan as $jamin);
                        <tr>
                            <td>{{$jamin->nomor}}</td>
                            <td>{{$jamin->tanggal}}</td>
                            <td>{{$jamin->penjamin}}</td>
                            <td>{{$jamin->bentuk_jaminan}}</td>
                            <td>{{number_format($jamin->jumlah,0,",",".")}}</td>
                            <td>{{$jamin->jenis_label}}</td>
                            <td>{{$jamin->tanggal_jatuh_tempo}}</td>
                            <td>{{$jamin->status}}</td>
                            <td>
                            <a class="btn btn-xs btn-primary" href="{{route('cetak.bpj', [$jamin->id, $dokumen->id])}}" target="_blank">Cetak</a>
                            @if($dokumen->status_id <= 4 )
                            <a class="btn btn-xs btn-danger" href="{{route('jaminan.unlink', [$jamin->id, $dokumen->id])}}" onclick="return confirm('Unlink jaminan ?');">Unlink</a>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>

                <h2>Dokumen Pabean:</h2>
                <div class="table-responsive">
                    <table class="table">
                        <tr class="info">
                            <th>Jenis</th>
                            <th>Nomor</th>
                            <th>tgl</th>
                        </tr>
                        <tr>
                            <td>Instruksi Pemeriksaan(IP)</td>

                            <td>{{$dokumen->ip['no_ip']}}</td>
                            <td>{{tgl_indo($dokumen->ip['created_at'])}}</td>
                        </tr>
                        <tr>
                            <td>LHP</td>
                            <td>{{$dokumen->lhp['no_lhp']}}</td>
                            <td>{{tgl_indo($dokumen->lhp['created_at'])}}</td>
                        </tr>
                        <tr>
                            <td>SPPB</td>
                            <td>{{$dokumen->sppb['no_sppb']}}</td>
                            <td>{{tgl_indo($dokumen->sppb['created_at'])}}</td>
                        </tr>
                    </table>
                </div>

                <h2>Dokumen Definitif:</h2>
                <div class="table-responsive">
                    <table class="table">
                        <tr  class="info">
                            <th>Dok. Jenis</th>
                            <th>Nomor</th>
                            <th>tgl</th>
                            <th>Billing</th>
                            <th>No. NTPN</th>
                            <th>Tgl. NTPN</th>
                            <th>Bayar</th>
                            <th>Act</th>
                        </tr>
                        @isset($dokumen->definitif['jenis'])
                        <tr>
                            <td>{{$dokumen->definitif->jenis}}</td>
                            <td>{{$dokumen->definitif->nomor}}</td>
                            <td>{{$dokumen->definitif->tanggal}}</td>
                            <td>{{$dokumen->definitif->billing}}</td>
                            <td>{{$dokumen->definitif->ntpn}}</td>
                            <td>{{$dokumen->definitif->tgl_ntpn}}</td>
                            <td class="text-right">{{number_format($dokumen->definitif->total_bayar,0,',','.')}}</td>
                            <td class="text-right">
                            </td>
                        </tr>
                        @endisset
                    </table>
                </div>
                
                <h2>Waktu Status:</h2>
                <div class="table-responsive">
                    <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                        <thead>
                            <tr class='danger'>
                                <th>Status</th>
                                <th>Trigered User</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dokumen->logStatus as $logStatus)
                            <tr>
                                <td style="text-align: center">{{$logStatus->status_label}}</td>
                                <td style="text-align: center">{{$logStatus->user_name}}</td>
                                <td style="text-align: center">{{tgl_indo_time($logStatus->created_at)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div> {{-- end-panel --}}

<!-- Modal Table Jaminan terus menerus-->
<div class="modal fade" id="jaminanTerusMenerus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-xl" role="document" style="width: 85%;">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cari Jaminan</h4>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table id="jaminan-terusmenerus" class="table table-condensed table-hover table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th>No BPJ</th>
                        <th>Tgl</th>
                        <th>Penjamin</th>
                        <th>Bentuk</th>
                        <th>Jumlah</th>
                        <th>Jenis</th>
                        <th>Saldo</th>
                        <th>Jatuh tempo</th>
                        <th>Status</th>
                        <th>Ket</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>

<!-- Modal rekam Jaminan-->
<div class="modal fade" id="jaminan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rekam BPJ</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('jaminan.store') }}">
                    {{ csrf_field() }}
                    <input id="dokid" type="hidden" class="form-control" name="dok_id" value="{{ $dokumen->id }}">
                    <div class="form-group{{ $errors->has('penjamin') ? ' has-error' : '' }}">
                        <label for="nomor" class="col-md-4 control-label">Nama</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control" name="penjamin" value="{{ old('penjamin') ? old('penjamin') : $dokumen->importir_nm }}"  autofocus>

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
                            <input id="name" type="text" class="form-control" name="npwp" value="{{ old('npwp') ? old('npwp') : $dokumen->importir_npwp }}"  autofocus>

                            @if ($errors->has('penjamin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('penjamin') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                        <label for="nomor" class="col-md-4 control-label">Alamat</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control" name="alamat" value="{{ old('alamat') ? old('alamat') : $dokumen->importir_alamat }}"  autofocus>

                            @if ($errors->has('penjamin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('penjamin') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                     <div class="form-group{{ $errors->has('nomor_jaminan') ? ' has-error' : '' }}">
                        <label for="nomor" class="col-md-4 control-label">No Jaminan</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control" name="nomor_jaminan" value="{{ old('nomor_jaminan') }}"  autofocus>

                            @if ($errors->has('nomor_jaminan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nomor_jaminan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                     <div class="form-group{{ $errors->has('tanggal_jaminan') ? ' has-error' : '' }}">
                        <label for="nomor" class="col-md-4 control-label">Tgl No Jaminan</label>

                        <div class="col-md-8 tgl_dok">
                            <input id="name" type="text" class="form-control" name="tanggal_jaminan" value="{{ old('tanggal_jaminan')}}"  autofocus>

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
                            <select class="form-control" name="bentuk_jaminan" id="bentuk" style=" width: 100%">
                                <option value=""></option>
                                <option value="TUNAI">TUNAI</option>
                                <option value="BANK">BANK</option>
                                <option value="CUSTOMS BOND">CUSTOMS BOND</option>
                                <option value="LAINNYA">LAINNYA</option>
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
                            <input id="jumlah" type="text" class="form-control" name="jumlah" value="{{ old('jumlah') }}" >

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
                            <select class="form-control" name="jenis" id="jenis" style=" width: 100%">
                                <option value=""></option>
                                <option value="1">SEKALI</option>
                                <option value="2">TERUS MENERUS</option>
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

                        <div class="col-md-8 tgl_dok">
                            <input id="tanggal_jatuh_tempo" type="text" class="form-control" name="tanggal_jatuh_tempo" value="{{ old('tanggal_jatuh_tempo') }}" >

                            @if ($errors->has('tanggal_jatuh_tempo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tanggal_jatuh_tempo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="konfirm()">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal rekam Dokumen Pelengkap-->
<div class="modal fade" id="dokumenPelengkap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rekam Dokumen Pelengkap</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('dokumen-pelengkap.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input id="dokid" type="hidden" class="form-control" name="dok_id" value="{{ $dokumen->id }}">
                    <div class="form-group{{ $errors->has('nama_dok') ? ' has-error' : '' }}">
                        <label for="nomor" class="col-md-4 control-label">Nama Dokumen</label>

                        <div class="col-md-8">
                            <input id="nama_dok" type="text" class="form-control" name="nama_dok" value="{{ old('nama_dok')}}"  autofocus>

                            @if ($errors->has('nama_dok'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_dok') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('npwp') ? ' has-error' : '' }}">
                        <label for="nomor" class="col-md-4 control-label">Nomor</label>

                        <div class="col-md-8">
                            <input id="no_dok" type="text" class="form-control" name="no_dok" value="{{ old('no_dok') }}"  autofocus>

                            @if ($errors->has('no_dok'))
                            <span class="help-block">
                                <strong>{{ $errors->first('no_dok') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tanggal_jatuh_tempo') ? ' has-error' : '' }}">
                        <label for="tanggal_jatuh_tempo" class="col-md-4 control-label">Tanggal</label>

                        <div class="col-md-8 tgl_dok">
                            <input id="#" type="text" class="form-control" name="tgl_dok" value="{{ old('tgl_dok') }}" >

                            @if ($errors->has('tgl_dok'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tgl_dok') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('file_dok') ? ' has-error' : '' }}">
                        <label for="file_dok" class="col-md-4 control-label">File</label>

                        <div class="col-md-8">
                            <input id="file_dok" type="file" class="form-control" name="file_dok" value="{{ old('file_dok') }}" >

                            @if ($errors->has('file_dok'))
                            <span class="help-block">
                                <strong>{{ $errors->first('file_dok') }}</strong>
                            </span>
                            @else
                            <span>wajib file, format: pdf, jpg, png, jpeg, max: 10M</span>
                            @endif
                        </div>
                    </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="konfirm()">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Pembatalan Dokumen-->
<div class="modal fade" id="pembatalan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pembatalan Dokumen</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('dokumen.pembatalan', $dokumen->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('keterangan_pembatalan') ? ' has-error' : '' }}">
                        <label for="nomor" class="col-md-3 control-label">Keterangan Alasan </label>

                        <div class="col-md-9">
                            <textarea class="form-control" name="keterangan_pembatalan" rows="3" value="{{ old('keterangan_pembatalan')}}" autofocus></textarea>

                            @if ($errors->has('keterangan_pembatalan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('keterangan_pembatalan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="konfirm()">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
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
    $('#tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $('#tempo input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $('.tgl_dok input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });

        /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        if (angka < 0) {
            alert('negatif');
        }
        
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split   = number_string.split(','),
        sisa    = split[0].length % 3,
        rupiah  = split[0].substr(0, sisa),
        ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function convertToAngka(value)
    {
        //replace titik dengan 
        var nilai = value.replace(/\./g,'');
        //replace koma dengan titk
        //
        var nilai = parseFloat(nilai.replace(',','.'));
        return nilai;
    }

        // Mengubah semua input menjadi format koma dan titik


    $(document).ready(function(){
        $('#jumlah').keyup(function(){
            $('#jumlah').val(formatRupiah($('#jumlah').val()));
        });

        $(function() {
            $('#jaminan-terusmenerus').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('jaminan.data.show', $dokumen->id) !!}',
                order: [ [0, 'desc'] ],
                columns: [
                    { data: 'nomor', name: 'nomor', className: "text-center" },
                    { data: 'tanggal', name: 'tanggal', className: "text-center" },
                    { data: 'penjamin', name: 'penjamin' },
                    { data: 'bentuk_jaminan', name: 'bentuk_jaminan', className: "text-center" },
                    { data: 'jumlah', name: 'jumlah', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: "text-right"},
                    { data: 'jenis_label', name: 'jenis_label', className: "text-center" },
                    { data: 'saldo', name: 'saldo', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: "text-right"},
                    { data: 'tanggal_jatuh_tempo', name: 'tanggal_jatuh_tempo', className: "text-center" },
                    { data: 'status', name: 'status', className: "text-center" },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    });

</script>


@endsection