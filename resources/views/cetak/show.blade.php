@extends('layouts.app')

@section('pageName')
Cetak Dokumen
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
                <h3>Cetak :</h3>
                <hr>
                <table class="table table-condensed">
                    <thead>
                        <th>#</th>
                        <th>Nama Dokumen</th>
                        <th>Ket</th>
                    </thead>
                    <tbody>
                        @if($dokumen->status_id > 2)
                        <tr>
                            <td>1</td>
                            <td>Instruksi Pemeriksaaan (IP)</td>
                            <td><a href="{{route('cetak.ip', $dokumen->id)}}">Cetak</a></td>
                        </tr>
                        @endif
                        @if($dokumen->status_id > 3)
                        <tr>
                            <td>2</td>
                            <td>Laporan Hasil Pemeriksaan (LHP)</td>
                            <td><a href="{{route('cetak.lhp', $dokumen->id)}}">Cetak</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Berita Acara Pemeriksaan Barang (BAP)</td>
                            <td><a href="{{route('cetak.ba', $dokumen->id)}}">Cetak</a></td>
                        </tr>
                        @endif
                        @if($dokumen->status_id > 4)
                        <tr>
                            <td>4</td>
                            <td>Penetapan Nilai Jaminan (PNJ)</td>
                            <td><a href="{{route('cetak.pnj', $dokumen->id)}}">Cetak</a></td>
                        </tr>
                        @endif
                        @if($dokumen->status_id > 6)
                        <tr>
                            <td>5</td>
                            <td>SPPB</td>
                            <td><a href="{{route('cetak.sppb', $dokumen->id)}}">Cetak</a></td>
                        </tr>
                        @endif
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> {{-- end-panel --}}

@endsection

@section('scripts')
@endsection