@extends('layouts.app')

@section('pageName')
IP
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"> Instruksi Pemeriksaan</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
        <table id="table-ip" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No. Daftar RH</th>
                    <th>Tgl</th>
                    <th>No. IP</th>
                    <th>Tgl</th>
                    <th>Importir</th>
                    <th>AWB</th>
                    <th>Pemeriksa</th>
                    <th>Periksa</th>
                    <th>Contoh</th>
                    <th>Foto</th>
                    <th>Updated_at</th>
                    <th style="text-align: center;">Ket</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function(){
        $(function() {
            $('#table-ip').DataTable({
                processing: true,
                serverSide: true,
                order: [ [10, 'desc'] ],
                ajax: '{!! route('instruksi-pemeriksaan.dataIp') !!}',
                columnDefs: [
                    {
                        "targets": [ 10 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                columns: [
                    { data: 'nomor', name: 'nomor', className: "text-center" },
                    { data: 'tgl', name: 'tgl', className: "text-center" },
                    { data: 'no_ip', name: 'no_ip', className: "text-center" },
                    { data: 'ip_tgl', name: 'ip_tgl', className: "text-center" },
                    { data: 'importir', name: 'importir' },
                    { data: 'awb', name: 'awb'},
                    { data: 'pemeriksa', name: 'pemeriksa' },
                    { data: 'tingkat_periksa', name: 'tingkat_periksa', className: "text-center" },
                    { data: 'aju_contoh', name: 'aju_contoh', className: "text-center" },
                    { data: 'aju_foto', name: 'aju_foto', className: "text-center" },
                    { data: 'updated_at', name: 'updated_at'},
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"}
                ]
            });
        });

    });

</script>
@endsection

