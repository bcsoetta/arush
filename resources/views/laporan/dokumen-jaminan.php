@extends('layouts.app') 
@section('pageName') Dokumen 
@endsection 
@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
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
                    <table class="table table-bordered" id="definitif-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor RH</th>
                                <th>Tanggal</th>
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
                                <th>Hari ke-</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no =1;
                            @endphp
                            @foreach ($dokumen as $dok)
                                <tr class="{{$dok->selisih_hari > 3 ? 'danger': ''}}">
                                    <td class="text-center">{{$no++}}</td>
                                    <td class="text-center">{{$dok->daftar_no}}</td>
                                    <td class="text-center">{{$dok->daftar_tgl}}</td>
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
                                    <td style="text-align:center">{{$dok->selisih_hari}}</td>
                                    <td><a class="btn btn-xs btn-primary" href="{{route('pendok.create', $dok->id)}}">Rekam PIB/PIBK</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection 
@section('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script>

    $(document).ready(function(){
        $(function() {
            $('#definitif-table').DataTable({
                processing: true,
                "pageLength": 200,
            });
        });
    });

    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        
        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
        
        // Create download link element
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        
            // Setting the file name
            downloadLink.download = filename;
            
            //triggering the function
            downloadLink.click();
        }
    }
</script>
@endsection