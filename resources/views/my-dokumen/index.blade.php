@extends('layouts.app')

@section('pageName')
My Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">My Dokumen RH</h3>
    </div>
    <div class="panel-body">
            <a href="{{ route('mydokumen.create')}}"><button class="btn btn-danger" style="margin: 15px; margin-left: 0px;">Rekam</button></a>
            <div class="table-responsive" style="margin-top: 2rem;">
                <table class="table table-bordered" id="mydocument-table">
                    <thead>
                        <tr class="">
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Importir</th>
                            <th>HAWB</th>
                            <th>Tgl</th>
                            <th>SPPB</th>
                            <th>Tgl</th>
                            <th>Waktu Keluar</th>
                            <th>PIB</th>
                            <th>Tgl</th>
                            <th>Tgl NTPN</th>
                            <th>Status</th>
                            <th>Status_id</th>
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
            $('#mydocument-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('mydokumen.data') !!}',
                order: [ [12,'asc'],[1, 'desc'] ],
                columnDefs:[
                    {
                        targets: [12],
                        visible : false,
                        searchable : false
                    }
                ],
                columns: [
                    { data: 'daftar_no', name: 'daftar_no', className: "text-center" },
                    { data: 'daftar_tgl', name: 'daftar_tgl', className: "text-center"},
                    { data: 'importir_nm', name: 'importir_nm' },
                    { data: 'hawb_no', name: 'hawb_no' },
                    { data: 'hawb_tgl', name: 'hawb_tgl', className: "text-center"},
                    { data: 'no_sppb', name: 'no_sppb', className: "text-center"},
                    { data: 'tgl_sppb', name: 'tgl_sppb', className: "text-center"},
                    { data: 'waktu_keluar', name: 'waktu_keluar', className: "text-center"},
                    { data: 'no_pib', name: 'no_pib', className: "text-center"},
                    { data: 'tgl_pib', name: 'tgl_pib', className: "text-center"},
                    { data: 'tgl_ntpn', name: 'tgl_ntpn', className: "text-center"},
                    { data: 'status_label', name: 'status_label' },
                    { data: 'status_id', name: 'status_id' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"}
                ]
            });
        });
        // AUTO REFRESH PAGE WHEN IN ACTIVE

            var refresh_rate = 200; //<-- In seconds, change to your needs
            var last_user_action = 0;
            var lost_focus = true;
            var focus_margin = 10; // If we lose focus more then the margin we want to refresh
            var allow_refresh = true; // on off sort of switch

            function keydown(evt) {
                if (!evt) evt = event;
                if (evt.keyCode == 192) {
                    // Shift+TAB
                    toggle_on_off();
                }
            } // function keydown(evt)


            function toggle_on_off() {
                if (can_i_refresh) {
                    allow_refresh = false;
                    console.log("Auto Refresh Off");
                } else {
                    allow_refresh = true;
                    console.log("Auto Refresh On");
                }
            }

            function reset() {
                last_user_action = 0;
                console.log("Reset");
            }

            function windowHasFocus() {
                lost_focus = false;
                console.log(" <~ Has Focus");
            }

            function windowLostFocus() {
                lost_focus = true;
                console.log(" <~ Lost Focus");
            }

            setInterval(function () {
                last_user_action++;
                refreshCheck();
            }, 1000);

            function can_i_refresh() {
                if (last_user_action >= refresh_rate && lost_focus && allow_refresh) {
                    return true;
                }
                return false;
            }

            function refreshCheck() {
                var focus = window.onfocus;

                if (can_i_refresh()) {
                    window.location.reload(); // If this is called no reset is needed
                    reset(); // We want to reset just to make sure the location reload is not called.
                } else {
                    console.log("Timer");
                }

            }
            window.addEventListener("focus", windowHasFocus, false);
            window.addEventListener("blur", windowLostFocus, false);
            window.addEventListener("click", reset, false);
            window.addEventListener("mousemove", reset, false);
            window.addEventListener("keypress", reset, false);
            window.onkeyup = keydown;
   });


</script>
@endsection