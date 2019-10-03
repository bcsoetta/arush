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
        <h2 class="panel-title"><strong>Edit Detail barang LHP</strong></h2>
    </div>
    <div class="panel-body">
        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                       <form class="form-horizontal" method="POST" action="{{ route('lhp.detailBarangUpdate', $barang->id) }}" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('jumlah_jenis_ukuran_kemasan') ? ' has-error' : '' }}">
                            <label for="jumlah_jenis_ukuran_kemasan" class="col-md-2 control-label">Jumlah jenis Ukuran Kemasan</label>
                            <div class="col-md-3">
                                <textarea class="form-control" rows="2" name="jumlah_jenis_ukuran_kemasan">{{$barang->jumlah_jenis_ukuran_kemasan}}</textarea>

                                 @if ($errors->has('jumlah_jenis_ukuran_kemasan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_jenis_ukuran_kemasan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('uraian') ? ' has-error' : '' }}">
                            <label for="uraian" class="col-md-2 control-label">Uraian</label>
                            <div class="col-md-3">
                                <textarea class="form-control" rows="2" name="uraian">{{$barang->uraian}}</textarea>

                                 @if ($errors->has('uraian'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('uraian') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('jumlah_satuan') ? ' has-error' : '' }}">
                            <label for="jumlah_satuan" class="col-md-2 control-label">Jumlah Satuan</label>
                            <div class="col-md-3">
                                <textarea class="form-control" rows="2" name="jumlah_satuan">{{$barang->jumlah_satuan}}</textarea>

                                 @if ($errors->has('jumlah_satuan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_satuan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('spesifikasi') ? ' has-error' : '' }}">
                            <label for="spesifikasi" class="col-md-2 control-label">Spesifikasi</label>
                            <div class="col-md-3">
                                <textarea class="form-control" rows="2" name="spesifikasi">{{$barang->spesifikasi}}</textarea>

                                 @if ($errors->has('spesifikasi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('spesifikasi') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('negara_asal') ? ' has-error' : '' }}">
                            <label for="negara_asal" class="col-md-2 control-label">Negara Asal</label>
                            <div class="col-md-3">
                                <textarea class="form-control" rows="2" name="negara_asal">{{$barang->negara_asal}}</textarea>

                                 @if ($errors->has('negara_asal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('negara_asal') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-2 control-label">Keterangan</label>
                            <div class="col-md-3">
                                <textarea class="form-control" rows="2" name="keterangan">{{$barang->keterangan}}</textarea>

                                 @if ($errors->has('keterangan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('keterangan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary pull-right" onclick="konfirm()">
                                    Simpan
                                </button>
                                <a style="margin-right: 5px;" class="btn btn-success pull-right" href="{{route('lhp.edit', $barang->dokumen_id)}}">Kembali</a>

                            </div>
                        </div>
                        </form>
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