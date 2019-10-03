@extends('layouts.app') 
@section('pageName') 
 Laporan Dokumen Belum Rekam definitif
@endsection 
@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
@section('content') {{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Laporan Dokumen Belum Rekam definitif</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="margin-top: 40px;" id="tblData">
                    <p>Dokumen lewat 3 hari kerja: <b>{{$dokumen->where('selisih_hari', '>',3)->count()}}</b> dari <b>{{$dokumen->count()}}</b></p>
                    <p>*Warna merah berarti dokumen sudah lewat 3(tiga) hari kerja dari SPPB</p>
                    <table class="table table-bordered display nowrap" id="definitif-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ACT</th>
                                <th>Nomor RH</th>
                                <th>Tanggal</th>
                                <th>Hari ke Stlh SPPB</th>
                                <th>Importir</th>
                                <th>NPWP</th>
                                <th>PPJK</th>
                                <th>No AWB</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>SPPB</th>
                                <th>Tanggal</th>
                                <th>Waktu Keluar</th>
                                <th>BM</th>
                                <th>PPN</th>
                                <th>PPNBM</th>
                                <th>PPH</th>
                                <th>TOTAL</th>
                                <th>NO BPJ</th>
                                <th>TGL</th>
                                <th>Jenis Jaminan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no =1;
                            @endphp
                            @foreach ($dokumen as $dok)
                                <tr class="{{$dok->selisih_hari > 3 ? 'danger': ''}}">
                                    <td class="text-center">{{$no++}}</td>
                                    <td><a class="btn btn-xs btn-primary" href="{{route('pendok.create', $dok->id)}}">Rekam PIB/PIBK</a></td>
                                    <td class="text-center">{{$dok->daftar_no}}</td>
                                    <td class="text-center">{{$dok->daftar_tgl}}</td>
                                    <td style="text-align:center">{{$dok->selisih_hari}}</td>
                                    <td>{{$dok->importir_nm}}</td>
                                    <td class="text-center">{{$dok->importir_npwp}}</td>
                                    <td>{{$dok->ppjk_nm}}</td>
                                    <td>{{$dok->hawb_no}}</td>
                                    <td>{{$dok->hawb_tgl}}</td>
                                    <td>{{$dok->lokasi_label}}</td>
                                    <td>{{$dok->status_label}}</td>
                                    <td>{{$dok->sppb->no_sppb}}</td>
                                    <td>{{$dok->sppb->created_at}}</td>
                                    <td>{{$dok->sppb->waktu_keluar}}</td>
                                    <td class="text-right">{{$dok->detail->sum('bayar_bm')}}</td>
                                    <td class="text-right">{{$dok->detail->sum('bayar_ppn')}}</td>
                                    <td class="text-right">{{$dok->detail->sum('bayar_ppnbm')}}</td>
                                    <td class="text-right">{{$dok->detail->sum('bayar_pph')}}</td>
                                    <td class="text-right">{{$dok->detail->sum('bayar_total')}}</td>
                                    <td>{{$dok->jaminan()->first()->nomor}}</td>
                                    <td>{{$dok->jaminan()->first()->tanggal}}</td>
                                    <td>{{$dok->jaminan()->first()->jenis_label}}</td>
                                    <td class="text-right">{{$dok->jaminan()->first()->jumlah}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div> {{-- end-panel --}} 
@endsection 
@section('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


<script>

    $(document).ready(function(){
        $(function() {
            $('#definitif-table').DataTable({
                paging: false,
                scrollY: 450,
                scrollX: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                columnDefs: [
                    { type: "string", targets: [4,6] }
                ]
            });
        });
    });
</script>
@endsection