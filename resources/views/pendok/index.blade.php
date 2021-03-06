@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Penerimaan Dokumen</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table-pendok" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No. Daftar RH</th>
                        <th>Tgl</th>
                        <th>Importir</th>
                        <th>HAWB</th>
                        <th>Tgl</th>
                        <th>No SPPB</th>
                        <th>Tgl</th>
                        <th>Status</th>
                        <th>Ket</th>
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
    $(document).ready(function () {
        $(function () {
            $('#table-pendok').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [
                    [6, 'desc']
                ],
                ajax: '{!! route('pendok.data') !!}',
                columns: [{
                    data: 'daftar_no',
                    name: 'dokumen.daftar_no',
                    className: "text-center"
                },
                {
                    data: 'daftar_tgl',
                    name: 'dokumen.daftar_tgl',
                    className: "text-center"
                },
                {
                    data: 'importir_nm',
                    name: 'dokumen.importir_nm'
                },
                {
                    data: 'hawb_no',
                    name: 'dokumen.hawb_no'
                },
                {
                    data: 'hawb_tgl',
                    name: 'dokumen.hawb_tgl',
                    className: "text-center"
                },
                {
                    data: 'no_sppb',
                    name: 'dokumen_sppb.no_sppb',
                    className: "text-center"
                },
                {
                    data: 'created_at',
                    name: 'dokumen_sppb.created_at',
                    className: "text-center"
                },
                {
                    data: 'status_label',
                    name: 'dokumen.status_label',
                    className: "text-center"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
                ]
            });
        });

    });
</script>
@endsection