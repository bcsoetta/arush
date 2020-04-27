@extends('layouts.app')

@section('pageName')
Laporan Hasil Pemeriksaan (LHP)
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Laporan Hasil Pemeriksaan (LHP)</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table-lhp" class="table table-condensed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No. Daftar RH</th>
                        <th>Tgl</th>
                        <th>No. LHP</th>
                        <th>Tgl</th>
                        <th>Importir</th>
                        <th>HAWB</th>
                        <th>Pemeriksa</th>
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
            $('#table-lhp').DataTable({
                processing: true,
                serverSide: true,
                order: [ [7, 'desc'] ],
                columnDefs: [
                    {
                        "targets": [ 7 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                ajax: '{!! route('lhp.dataLhp') !!}',
                columns: [
                    { data: 'daftar_no', name: 'dokumen.daftar_no', className: "text-center" },
                    { data: 'daftar_tgl', name: 'dokumen.daftar_tgl', className: "text-center" },
                    { data: 'no_lhp', name: 'dokumen_lhp.no_lhp', className: "text-center" },
                    { data: 'created_at', name: 'dokumen_lhp.created_at', className: "text-center" },
                    { data: 'importir_nm', name: 'dokumen.importir_nm' },
                    { data: 'hawb_no', name: 'dokumen.hawb_no'},
                    { data: 'pemeriksa_nama', name: 'dokumen_lhp.pemeriksa_nama' },
                    { data: 'updated_at', name: 'dokumen.updated_at'},
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    });

</script>
@endsection

