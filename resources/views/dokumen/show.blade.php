@extends('layouts.app')

@section('pageName')
Dokumen Lengkap
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
                {{-- parsial --}}
                @include('partial.header-dokumen')
                <h3>Dokumen :
                @can('EDIT-DOKUMEN')
                @if($dokumen->status_id <= 4)
                <a href="{{ route('dokumen.edit', $dokumen->id)}}"><button class="btn btn-danger pull-right" style="margin: 10px">Edit</button></a>
                @endif
                @endcan   
                </h3>
                <table class="table table-hover table-striped table-condensed table-borderless">
                    <tr>
                        <th>Nomor</th>
                        <td>:</td>
                        <th style="background-color: yellow">{{$dokumen->daftar_no}}</th>
                        <th colspan="3">Tanggal : {{$dokumen->daftar_tgl}}</th>
                    </tr>
                    <tr>
                        <th colspan="6"><h4>Importir</h4></th>
                    </tr>
                    <tr>
                        <th>NPWP</th>
                        <td>:</td>
                        <td colspan="5">{{$dokumen->importir_npwp}}</td>
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
                        <td colspan="5">{{$dokumen->ppjk_npwp}}</td>
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
                        <th colspan="6"><h4>Manifest</h4></th>
                    </tr>
                    <tr>
                        <th>MAWB</th>
                        <td>:</td>
                        <td>Nomor : {{$dokumen->mawb_no}}</td>
                        <td colspan="3">Tanggal : {{$dokumen->mawb_tgl}}</td>
                    </tr>
                    <tr>
                        <th>HAWB</th>
                        <td>:</td>
                        <td>Nomor : {{$dokumen->hawb_no}}</td>
                        <td colspan="3">Tanggal : {{$dokumen->hawb_tgl}}</td>
                    </tr>
                    <tr>
                        <th>BC 11</th>
                        <td>:</td>
                        <td>Nomor : {{$dokumen->bc11_no}}</td>
                        <td>Pos : {{$dokumen->bc11_pos}}</td>
                        <td>Sub : {{$dokumen->bc11_sub}}</td>
                        <td>Tanggal : {{$dokumen->bc11_tgl}}</td>
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
                        <th colspan="6"><h4>Fasilitas</h4></th>
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
        </div>
    </div>
</div> {{-- end-panel --}}

@endsection

@section('scripts')
@endsection