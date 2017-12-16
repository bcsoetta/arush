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

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Rekam Dokumen</h3>
    </div>
    <div class="panel-body">
        <form method="POST" action="{{ route('dokumen.store') }}">
        {{ csrf_field() }}
        {{-- parsial form --}}
        @include('partial._form_dokumen')
        </form>
    </div>
</div> {{-- end-panel --}}
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

    $(function() {
        $("#importir_nm").autocomplete({
            source:  "{{route('auto.importir')}}",
            minLength: 1,
            autoFocus:true,
            select: function( event, ui ) {
                $('#importir_nm').val(ui.item.nama);
                $('#importir_npwp').val(ui.item.npwp);
                $('#importir_alamat').val(ui.item.alamat);
            }
        });
    });

    $(function() {
        $("#ppjk_nm").autocomplete({
            source:  "{{route('auto.ppjk')}}",
            minLength: 1,
            autoFocus:true,
            select: function( event, ui ) {
                $('#ppjk_nm').val(ui.item.nama);
                $('#ppjk_npwp').val(ui.item.npwp);
                $('#ppjk_alamat').val(ui.item.alamat);
            }
        });
    });
</script>
@endsection
