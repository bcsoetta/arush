@extends('layouts.app')

@section('pageName')
Edit Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Dokumen</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <a href="{{ route('mydokumen.show', $dokumen->id)}}"><button class="btn btn-primary pull-right" style="margin: 10px">Kembali</button></a>
        </div>
        <form method="POST" action="{{ route('mydokumen.update', $dokumen->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        {{-- parsial form --}}
        @include('partial._form_dokumen_edit')
        </form>
    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')
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
</script>
@endsection
