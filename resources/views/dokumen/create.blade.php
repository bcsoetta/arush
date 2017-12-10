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
    var options = {
            source: '{{url('importir')}}',
            minLength:2,
            autoFocus: true,
            select: function(event, ui) {
                $('#importir').val(ui.item.value);
        }
    };

    var selector = 'input#importir';
    $(document).on('keydown.autocomplete', selector, function() {
            $(this).autocomplete(options);
    });

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
</script>
@endsection
