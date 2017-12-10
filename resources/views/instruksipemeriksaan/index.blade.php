@extends('layouts.app')

@section('pageName')
IP
@endsection

@section('styles')
@endsection

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Instruksi Pemeriksaan</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dokumen nomor</th>
                    <th>Importir</th>
                    <th>Ppjk</th>
                    <th>MAWB</th>
                    <th>HAWB</th>
                    <th>Pemeriksa</th>
                    <th>Periksa</th>
                    <th>Kemasan diperiksa</th>
                    <th>Contoh</th>
                    <th>Foto</th>
                    <th style="text-align: center;">Ket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ip as $dok)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$dok->dokumen->daftar_no}}</td>
                    <td>{{$dok->dokumen->importir_nm}}</td>
                    <td>{{$dok->dokumen->ppjk_nm}}</td>
                    <td>{{$dok->dokumen->mawb_no}}</td>
                    <td>{{$dok->dokumen->hawb_no}}</td>
                    <td>{{$dok->pemeriksa_nama}}</td>
                    <td>{{$dok->tingkat_periksa}}</td>
                    <td>{{$dok->jumlah_kemasan_diperiksa}}</td>
                    <td>{{$dok->aju_contoh}}</td>
                    <td>{{$dok->aju_foto}}</td>
                    <td style="text-align: center;">
                    @can('CREATE-LHP')
                    @if($dok->dokumen->status_id == 3)
                    <a class="btn btn-danger btn-xs" href="{{ route('lhp.create', $dok->dokumen->id)}}">Rekam LHP</a>
                    @endif
                    @endcan
                    <a class="btn btn-primary btn-xs" href="{{ route('cetak.ip', $dok->dokumen->id)}}">Cetak IP</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')

@endsection

