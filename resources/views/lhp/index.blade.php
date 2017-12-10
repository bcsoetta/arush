@extends('layouts.app')

@section('pageName')
Laporan Hasil Pemeriksaan (LHP)
@endsection

@section('styles')
@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Laporan Hasil Pemeriksaan (LHP)</h3>
    </div>
    <div class="panel-body">
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
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lhp as $dok)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$dok->dokumen->daftar_no}}</td>
                    <td>{{$dok->dokumen->importir_nm}}</td>
                    <td>{{$dok->dokumen->ppjk_nm}}</td>
                    <td>{{$dok->dokumen->mawb_no}}</td>
                    <td>{{$dok->dokumen->hawb_no}}</td>
                    <td>{{$dok->pemeriksa_nama}}</td>
                    <td>
                    <a class="btn btn-danger btn-xs" href="{{ route('lhp.show', $dok->dokumen->id)}}">Lihat</a>
                    <a class="btn btn-primary btn-xs" href="{{ route('cetak.lhp', $dok->dokumen->id)}}">Cetak LHP</a>
                    <a class="btn btn-primary btn-xs" href="{{ route('cetak.ba', $dok->dokumen->id)}}">Cetak BA</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')

@endsection

