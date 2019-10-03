@extends('layouts.app')

@section('pageName')
Jaminan
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Jaminan</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table-jaminan" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No BPJ</th>
                        <th>Tgl</th>
                        <th>Penjamin</th>
                        <th>Bentuk</th>
                        <th>Jumlah</th>
                        <th>Jenis</th>
                        <th>Sisa Saldo</th>
                        <th>Jatuh tempo</th>
                        <th>Pengembalian</th>
                        <th>Tgl</th>
                        <th>Agenda</th>
                        <th>Status</th>
                        <th>Updated_at</th>
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
            $('#table-jaminan').DataTable({
                processing: true,
                serverSide: true,
                order: [ [9, 'desc'] ],
                ajax: '{!! route('jaminan.data') !!}',
                columns: [
                    { data: 'nomor', name: 'nomor', className: "text-center" },
                    { data: 'tanggal', name: 'tanggal', className: "text-center" },
                    { data: 'penjamin', name: 'penjamin' },
                    { data: 'bentuk_jaminan', name: 'bentuk_jaminan', className: "text-center" },
                    { data: 'jumlah', name: 'jumlah', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: "text-right"},
                    { data: 'jenis_label', name: 'jenis_label', className: "text-center" },
                    { data: 'saldo', name: 'saldo', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: "text-right"},
                    { data: 'tanggal_jatuh_tempo', name: 'tanggal_jatuh_tempo', className: "text-center" },
                    { data: 'no_bukti_pengembalian', name: 'no_bukti_pengembalian', className: "text-center" },
                    { data: 'tgl_bukti_pengembalian', name: 'tgl_bukti_pengembalian', className: "text-center" },
                    { data: 'kode_agenda', name: 'kode_agenda', className: "text-center" },
                    { data: 'status', name: 'status', className: "text-center" },
                    { data: 'updated_at', name: 'updated_at', className: "text-center" },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    });

</script>
@endsection