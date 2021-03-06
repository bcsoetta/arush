@extends('layouts.app')

@section('pageName')
Proses Pengeluaran
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Proses Pengeluaran</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table-gate" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No. Daftar RH</th>
                        <th>Tgl</th>
                        <th>Importir</th>
                        <th>HAWB</th>
                        <th>Tgl</th>
                        <th>No SPPB</th>
                        <th>Tgl</th>
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
   $(document).ready(function(){
        $(function() {
            $('#table-gate').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'],[1, 'desc'] ],
                ajax: '{!! route('gateout.data') !!}',
                columns: [
                    { data: 'daftar_no', name: 'dokumen.daftar_no', className: "text-center" },
                    { data: 'daftar_tgl', name: 'dokumen.daftar_tgl', className: "text-center" },
                    { data: 'importir_nm', name: 'dokumen.importir_nm' },
                    { data: 'hawb_no', name: 'dokumen.hawb_no' },
                    { data: 'hawb_tgl', name: 'dokumen.hawb_tgl', className: "text-center"},
                    { data: 'no_sppb', name: 'dokumen_sppb.no_sppb', className: "text-center"},
                    { data: 'created_at', name: 'dokumen_sppb.created_at', className: "text-center"},
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"}
                ]
            });
        });

    });

</script>
@endsection

