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
                    { data: 'daftar_no', name: 'dokumen.daftar_no', className: "text-center" },
                    { data: 'daftar_tgl', name: 'dokumen.daftar_tgl', className: "text-center" },
                    { data: 'no_ip', name: 'dokumen_ip.no_ip', className: "text-center" },
                    { data: 'created_at', name: 'dokumen_ip.created_at', className: "text-center" },
                    { data: 'importir_nm', name: 'dokumen.importir_nm' },
                    { data: 'hawb_no', name: 'dokumen.hawb_no'},
                    { data: 'pemeriksa_nama', name: 'dokumen_ip.pemeriksa_nama' },
                    { data: 'tingkat_periksa', name: 'dokumen_ip.tingkat_periksa', className: "text-center" },
                    { data: 'aju_contoh', name: 'dokumen_ip.aju_contoh', className: "text-center" },
                    { data: 'aju_foto', name: 'dokumen_ip.aju_foto', className: "text-center" },
                    { data: 'updated_at', name: 'dokumen.updated_at'},
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"}
                ]
            });
        });

    });

</script>
@endsection

