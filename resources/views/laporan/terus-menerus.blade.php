@extends('layouts.app') 
@section('pageName') Dokumen 
@endsection 
@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@section('content') {{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Laporan Jaminan Harian</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline" method="get" action="{{ route('laporan.hariAntara') }}" style="margin-top: 20px">
                    <div class="form-group tgl">
                        <input type="text" class="form-control" id="" placeholder="Tgl Awal Jaminan" name="tgl_awal">
                    </div>
                    <div class="form-group tgl">
                        <input type="text" class="form-control" id="" placeholder="Tgl akhir Jaminan" name="tgl_akhir">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
            @if(isset($dokumen))
                <div class="table-responsive" style="margin-top: 40px;" id="tblData">
                    <table class="table table-bordered" id="users-table">
                        <thead>
                            <tr>
                                <th>Nomor RH</th>
                                <th>Tanggal</th>
                                <th>Penjamin</th>
                                <th>BM</th>
                                <th>PPN</th>
                                <th>PPNBM</th>
                                <th>PPH 22</th>
                                <th>Total</th>
                                <th>No BPJ</th>
                                <th>Tgl</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumen as $doku)
                                <tr>
                                    <td style="text-align: center">{{str_pad($doku->daftar_no, 5, '0', STR_PAD_LEFT)}}</td>
                                    <td style="text-align: center">{{date('d-m-Y', strtotime($doku->daftar_tgl))}}</td>
                                    <td>{{$doku->penjamin}}</td>
                                    <td style="text-align: right">{{number_format($doku->bm,2,",",".")}}</td>
                                    <td style="text-align: right">{{number_format($doku->ppn,2,",",".")}}</td>
                                    <td style="text-align: right">{{number_format($doku->ppnbm,2,",",".")}}</td>
                                    <td style="text-align: right">{{number_format($doku->pph,2,",",".")}}</td>
                                    <td style="text-align: right">{{number_format($doku->total,2,",",".")}}</td>
                                    <td style="text-align: center">{{str_pad($doku->nomor, 5, '0', STR_PAD_LEFT)}}</td>
                                    <td style="text-align: center">{{date('d-m-Y', strtotime($doku->tanggal))}}</td>
                                    <td style="text-align: right">{{number_format($doku->jumlah,2,",",".")}}</td>
                                </tr>
                            @endforeach
                            @if(isset($dokumen_total))
                            <tr>
                                <th colspan="3"  style="text-align: center">TOTAL</th>
                                <th style="text-align: right">{{number_format($dokumen_total->bm,2,",",".")}}</th>
                                <th style="text-align: right">{{number_format($dokumen_total->ppn,2,",",".")}}</th>
                                <th style="text-align: right">{{number_format($dokumen_total->ppnbm,2,",",".")}}</th>
                                <th style="text-align: right">{{number_format($dokumen_total->pph,2,",",".")}}</th>
                                <th style="text-align: right">{{number_format($dokumen_total->total,2,",",".")}}</th>
                                <th colspan="2"  style="text-align: center">TOTAL</td>
                                <th style="text-align: right">{{number_format($dokumen_total->jumlah,2,",",".")}}</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary" onclick="exportTableToExcel('tblData', 'laporan jaminan harian')">Export Table Data To Excel File</button>
            @endif
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