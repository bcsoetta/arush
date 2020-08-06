@extends('layouts.app')

@section('pageName')
Lhp
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<style>
input, textarea {
    font-weight:bold;
    }

</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Rekam Lembar Hasil Pemeriksaan</div>

                <div class="panel-body">
                    <div class="row">
                        <a href="{{ route('instruksi-pemeriksaan.index')}}"><button class="btn btn-primary pull-right" style="margin: 10px">Kembali</button></a>                        
                    </div>
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('lhp.store', $dokumen->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('tgl_periksa') ? ' has-error' : '' }}">
                            <label for="tgl_periksa" class="col-md-2 control-label">Nomor Pendaftaran RH</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="tgl_periksa" value="{{$dokumen->daftar_no}} Tanggal {{tgl_indo($dokumen->daftar_tgl)}}" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tgl_periksa') ? ' has-error' : '' }}" id="tgl">
                            <label for="tgl_periksa" class="col-md-2 control-label">Tanggal Periksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="tgl_periksa">
                                @if ($errors->has('tgl_periksa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tgl_periksa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jam_periksa') ? ' has-error' : '' }}">
                            <label for="jam_periksa" class="col-md-2 control-label">Jam Mulai Periksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="jam_periksa" id="jam_periksa">
                                @if ($errors->has('jam_periksa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jam_periksa') }}</strong>
                                </span>
                                @endif
                                <span>contoh 10:30</span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jam_selesai') ? ' has-error' : '' }}">
                            <label for="jam_selesai" class="col-md-2 control-label">Jam Selesai Periksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="jam_selesai" id="jam_selesai">
                                @if ($errors->has('jam_selesai'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jam_selesai') }}</strong>
                                </span>
                                @endif
                                <span>contoh 11:30</span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                            <label for="lokasi" class="col-md-2 control-label">Lokasi</label>

                            <div class="col-md-10">
                                <select class="form-control" name="lokasi" id="pilih">
                                        <option value="" selected></option>
                                        @foreach($lokasi as $tempat)
                                        <option value="{{$tempat->kode}}">{{$tempat->kode}}-{{$tempat->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('lokasi'))
                                    <span class="help-block">
                                        {{ $errors->first('lokasi') }}
                                    </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jumlah_partai_barang') ? ' has-error' : '' }}">
                            <label for="jumlah_partai_barang" class="col-md-2 control-label">Jumlah partai barang</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="jumlah_partai_barang">
                                @if ($errors->has('jumlah_partai_barang'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_partai_barang') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('no_kemasan') ? ' has-error' : '' }}">
                            <label for="no_kemasan" class="col-md-2 control-label">Nomor Kemasan yang diperiksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="no_kemasan">
                                @if ($errors->has('no_kemasan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_kemasan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kondisi_segel') ? ' has-error' : '' }}">
                            <label for="kondisi_segel" class="col-md-2 control-label">Kondisi Segel</label>

                            <div class="col-md-10">
                                <label class="radio-inline">
                                    <input type="radio" name="kondisi_segel" id="inlineRadio1" value="utuh"> Utuh
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="kondisi_segel" id="inlineRadio2" value="rusak"> Rusak
                                </label>
                                @if ($errors->has('kondisi_segel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kondisi_segel') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jumlah_jenis_barang_diperiksa') ? ' has-error' : '' }}">
                            <label for="jumlah_jenis_barang_diperiksa" class="col-md-2 control-label">Jumlah &amp; Jenis Barang yang diperiksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="jumlah_jenis_barang_diperiksa">
                                @if ($errors->has('jumlah_jenis_barang_diperiksa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_jenis_barang_diperiksa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hasil_pemeriksaan') ? ' has-error' : '' }}">
                            <label for="hasil_pemeriksaan" class="col-md-2 control-label">Hasil Pemeriksaaan :</label>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div  class="table-responsive">
                                    <table class="table table-hover table-bordered" id="hasil_periksa">
                                        <thead>
                                            <th>No</th>
                                            <th>Jumlah, Jenis, Ukuran Kemasan</th>
                                            <th>Uraian Barang</th>
                                            <th>Jumlah Satuan Barang</th>
                                            <th>Spesifikasi (merk/tipe/kapasitas)</th>
                                            <th>Negara Asal</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr class="rowbaru">
                                                <td class="count">1</td>
                                                <td>
                                                    <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="jumlah_jenis_ukuran_kemasan[]"></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="uraian[]"></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="jumlah_satuan[]"></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="spesifikasi[]"></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="negara_asal[]"></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="keterangan[]"></textarea>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <a class="btn btn-primary pull-right" id="add-field"> Tambah 
                                        </a>
                                    </div>
                                </div>                                
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('kesimpulan') ? ' has-error' : '' }}">
                            <label for="kesimpulan" class="col-md-2 control-label">Kesimpulan</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" name="kesimpulan"></textarea>

                                 @if ($errors->has('kesimpulan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kesimpulan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('photos') ? ' has-error' : '' }}">
                            <label for="photos" class="col-md-2 control-label">Upload Foto</label>

                            <div class="col-md-10">
                                <input type="file" id="photo" name="photos[]" multiple>
                                @if ($errors->has('photos'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photos') }}</strong>
                                </span>
                                @endif
                                <span>Upload lebih dari satu photo tekan tahan tombol Ctrl</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-11">
                                <button type="submit" class="btn btn-primary pull-right" onclick="konfirm()">
                                    Simpan
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<table id="prototype" style="display: none;">
    <tr class="rowbaru">
        <td class="count">1</td>
        <td>
            <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="jumlah_jenis_ukuran_kemasan[]"></textarea>
        </td>
        <td>
            <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="uraian[]"></textarea>
        </td>
        <td>
            <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="jumlah_satuan[]"></textarea>
        </td>
        <td>
            <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="spesifikasi[]"></textarea>
        </td>
        <td>
            <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="negara_asal[]"></textarea>
        </td>
        <td>
            <textarea class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" rows="3" name="keterangan[]"></textarea>
        </td>
        <td>
            <a href="javascript:;" class="btn btn-danger removeTr">
                x
        </td>
    </tr>
</table>
@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
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

