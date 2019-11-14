@extends('layouts.app') 
@section('pageName') Download Data 
@endsection 
@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@section('content') {{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Download Data</h3>
    </div>
    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
            <h1>Dokumen</h1>
                <form class="form-inline" method="get" action="{{ route('laporan.downloadDokumen') }}" style="margin-top: 20px">
                    <div class="form-group tgl">
                        <input type="text" class="form-control" id="" placeholder="Tgl Awal" name="tgl_awal">
                    </div>
                    <div class="form-group tgl">
                        <input type="text" class="form-control" id="" placeholder="Tgl akhir" name="tgl_akhir">
                    </div>
                    <button type="submit" class="btn btn-primary">Download</button>

                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
            <h1>Detail Dokumen</h1>
                <form class="form-inline" method="get" action="{{ route('laporan.downloadDetail') }}" style="margin-top: 20px">
                    <div class="form-group tgl">
                        <input type="text" class="form-control" id="" placeholder="Tgl Awal" name="tgl_awal">
                    </div>
                    <div class="form-group tgl">
                        <input type="text" class="form-control" id="" placeholder="Tgl akhir" name="tgl_akhir">
                    </div>
                    <button type="submit" class="btn btn-primary">Download</button>

                </form>
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