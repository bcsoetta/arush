@extends('layouts.app') 
@section('pageName') Dokumen 
@endsection 
@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@section('content') {{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Laporan Dokumen Sudah SPPB belum Keluar</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="margin-top: 40px;" id="tblData">
            <span class=''>*Warna merah berarti dokumen sudah lewat 3(tiga) hari dari SPPB</span>
                    <table class="table table-bordered" id="users-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor RH</th>
                                <th>Tanggal</th>
                                <th>Importir</th>
                                <th>PPJK</th>
                                <th>No AWB</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>SPPB</th>
                                <th>Tanggal</th>
                                <th>Waktu Keluar</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no =1;
                            @endphp
                            @foreach ($dokumen as $dok)
                            @php
                                $date1 = date_create(date('Y-m-d', strtotime($dok->sppb->created_at)));
                                $date2 = date_create(date('Y-m-d'));
                                $diff1 = date_diff($date1,$date2);
                                $diff2 = (int) $diff1->format("%a");

                            @endphp
                                <tr class="{{$diff2 > 3 ? 'danger': ''}}">
                                    <td>{{$no++}}</td>
                                    <td>{{$dok->daftar_no}}</td>
                                    <td>{{$dok->daftar_tgl}}</td>
                                    <td>{{$dok->importir_nm}}</td>
                                    <td>{{$dok->ppjk_nm}}</td>
                                    <td>{{$dok->hawb_no}}</td>
                                    <td>{{$dok->hawb_tgl}}</td>
                                    <td>{{$dok->lokasi_label}}</td>
                                    <td>{{$dok->status_label}}</td>
                                    <td>{{$dok->sppb->no_sppb}}</td>
                                    <td>{{$dok->sppb->created_at}}</td>
                                    <td>{{$dok->sppb->waktu_keluar}}</td>
                                    <td><a class="btn btn-xs btn-primary" href="{{route('pendok.create', $dok->id)}}">Rekam PIB/PIBK</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary" onclick="exportTableToExcel('tblData', 'laporan Dokumen belu definitif')">Export Table Data To Excel File</button>
            </div>
        </div>

    </div>
</div> {{-- end-panel --}} 
@endsection 
@section('scripts')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $('.tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
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