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
        <h3 class="panel-title">Laporan Dokumen RH</h3>
    </div>
    <div class="panel-body">
        @can("CREATE-DOKUMEN")
        @endcan
            <div class="row">
                <div class="col-md-12">
                    <form action="#" method="get">
                        <input type="button" value="">
                    </form>
                </div>
            </div>
            <div class="table-responsive" style="margin-top: 2rem;">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Importir</th>
                            <th>Ppjk</th>
                            <th>HAWB</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function(){
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [ [1, 'desc'] ],
                ajax: '{!! route('dokumen.data') !!}',
                columns: [
                    { data: 'daftar_no', name: 'daftar_no' },
                    { data: 'daftar_tgl', name: 'daftar_tgl' },
                    { data: 'importir_nm', name: 'importir_nm' },
                    { data: 'ppjk_nm', name: 'ppjk_nm' },
                    { data: 'hawb_no', name: 'hawb_no' },
                    { data: 'status_label', name: 'status_label' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
   });
</script>
@endsection



