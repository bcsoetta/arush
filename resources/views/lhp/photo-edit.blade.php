@extends('layouts.app')

@section('pageName')
LHP
@endsection

@section('styles')
<link href="{{ asset('css/ekko-lightbox.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title"><strong>Hapus Photo Barang LHP</strong></h2>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($photos) > 0)
                            @foreach($photos as $photo)
                            <tr>
                                <td>
                                    <img src="{{asset("storage/lhp_photos/$photo->filename")}}" style="width: 200px;">
                                </td>
                                <td>
                                    <form action="{{ route('lhp.photoDestroy', $photo->id) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <input class="btn btn-danger" type="submit" value="Delete" />
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    $('#tgl input').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $("#pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $("#pilih-jaminan").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    //auto number row
    function autoNumberRow(){
        $('.count').each(function(i){
          $(this).text(i + 1);
        });
    };

    //add row tr
    $("#add-field").click(function(e) {
        var varRow = $('#prototype tr').clone();
        $('#hasil_periksa > tbody:last').append(varRow);
        autoNumberRow();
    });

    //delete row tr
    $('form').on('click', '.removeTr', function(){
        $(this).closest('tr').remove();
         autoNumberRow();
    });
    $('#jam_periksa').mask('00:00');
    $('#jam_selesai').mask('00:00');
</script>
@endsection