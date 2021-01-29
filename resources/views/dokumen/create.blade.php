@extends('layouts.app')

@section('pageName')
Rekam Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- over view --}}

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Rekam Dokumen</h3>
    </div>
    <div class="panel-body">
        <a href="{{ url()->previous() }}"><button class="btn btn-primary" style="margin: 15px; margin-left: 0px;">Kembali</button></a>
        <form method="POST" action="{{ route('dokumen.store') }}">
            {{ csrf_field() }}
            {{-- parsial form --}}
            @include('partial._form_dokumen')
        </form>
    </div>
</div> {{-- end-panel --}}
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <h4 class="modal-title" id="myModalLabel">Dokumen Yang belum diserahkan</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="mytable1">
                    <thead>
                        <tr>
                            <th>No Daftar</th>
                            <th>Tgl</th>
                            <th>Importir</th>
                            <th>NPWP</th>
                            <th>HAWB</th>
                            <th>Tgl</th>
                            <th>SPPB</th>
                            <th>Tgl</th>
                            <th>Lewat hari</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('#tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $('.input_tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $('#tgl_jaminan input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "top auto",
        autoclose: true,
        todayHighlight: true
    });
    $("#pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $("#angkut").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $(".pilih-select").select2({
        placeholder: "Pilih",
        allowClear: true
    });

    $(function() {
        $("#importir_nm").autocomplete({
            source: "{{route('auto.importir')}}",
            minLength: 1,
            autoFocus: true,
            select: function(event, ui) {
                $('#importir_nm').val(ui.item.nama);
                $('#importir_npwp').val(ui.item.npwp);
                $('#importir_alamat').val(ui.item.alamat);
            }
        });
    });

    $(function() {
        $("#ppjk_nm").autocomplete({
            source: "{{route('auto.ppjk')}}",
            minLength: 1,
            autoFocus: true,
            select: function(event, ui) {
                $('#ppjk_nm').val(ui.item.nama);
                $('#ppjk_npwp').val(ui.item.npwp);
                $('#ppjk_alamat').val(ui.item.alamat);
            }
        });
    });

    $(document).on('change', function() {
        var npwp = $('#importir_npwp').val();

        if (npwp !== null && npwp !== '' && npwp !== undefined) {
            $.ajax({
                url: "{{url('cek-dokumen-npwp')}}" + '/' + npwp,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    // $('#myModal').modal('show');
                    $('#myModal').modal({
                        backdrop: 'static'
                    });
                    $.each(data, function(k, v) {
                        var classD = v.selisih_hari > 3 ? 'danger' : '';

                        $("#mytable1 > tbody").append(
                            "<tr class='" + classD + "'>" +
                            "<td>" + v.daftar_no + "</td>" +
                            "<td>" + v.daftar_tgl + "</td>" +
                            "<td>" + v.importir_nm + "</td>" +
                            "<td>" + v.importir_npwp + "</td>" +
                            "<td>" + v.hawb_no + "</td>" +
                            "<td>" + v.hawb_tgl + "</td>" +
                            "<td>" + v.sppb.no_sppb + "</td>" +
                            "<td>" + v.sppb.created_at + "</td>" +
                            "<td>" + v.selisih_hari + "</td>" +
                            "</tr>");
                    })

                }
            });
        } else {
            console.log('empty');
        }

    });
</script>
@endsection