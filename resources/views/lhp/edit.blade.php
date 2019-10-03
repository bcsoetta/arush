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
        <h2 class="panel-title"><strong>Laporan Hasil pemeriksaan (LHP)</strong></h2>
    </div>
    <div class="panel-body">
        <div class="row">

            <div class="col-md-12">
                <h3>Laporan Hasil Pemeriksaan :</h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                       <form class="form-horizontal" method="POST" action="{{ route('lhp.update', $lhp->id) }}" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('tgl_periksa') ? ' has-error' : '' }}" id="tgl">
                                <label for="tgl_periksa" class="col-md-2 control-label">Nomor Pendaftaran RH</label>

                                <div class="col-md-10">
                                    <p>{{$lhp->dokumen->daftar_no}} Tanggal {{$lhp->dokumen->daftar_tgl}}</p>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tgl_periksa') ? ' has-error' : '' }}" id="tgl">
                                <label for="tgl_periksa" class="col-md-2 control-label">Nomor LHP</label>

                                <div class="col-md-10">
                                    <p>{{$lhp->no_lhp}} Tanggal {{$lhp->created_at}}</p>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tgl_periksa') ? ' has-error' : '' }}" id="tgl">
                                <label for="tgl_periksa" class="col-md-2 control-label">Tanggal Periksa</label>

                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="tgl_periksa" value="{{$lhp->tgl_periksa}}">
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
                                    <input id='jam_periksa' type="text" class="form-control" name="jam_periksa" placeholder="00:00" value="{{$lhp->jam_periksa}}">
                                    @if ($errors->has('jam_periksa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jam_periksa') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('jam_selesai') ? ' has-error' : '' }}">
                                <label for="jam_selesai" class="col-md-2 control-label">Jam Selesai Periksa</label>

                                <div class="col-md-10">
                                    <input id='jam_selesai' type="text" class="form-control" name="jam_selesai" placeholder="00:00" value="{{$lhp->jam_selesai}}">
                                    @if ($errors->has('jam_selesai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jam_selesai') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                                <label for="lokasi" class="col-md-2 control-label">Lokasi</label>

                                <div class="col-md-10">
                                    <select class="form-control" name="lokasi" id="pilih">
                                        <option value="{{$lhp->lokasi}}" selected>{{$lhp->lokasi}}</option>
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
                                    <input type="text" class="form-control" name="jumlah_partai_barang" value="{{$lhp->jumlah_partai_barang}}">
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
                                    <input type="text" class="form-control" name="no_kemasan" value="{{$lhp->no_kemasan}}">
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
                                        <input type="radio" name="kondisi_segel" id="inlineRadio1" {{$lhp->kondisi_segel == "utuh" ? 'checked' : ''}}> Utuh
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="kondisi_segel" id="inlineRadio2" {{$lhp->kondisi_segel == "rusak" ? 'checked' : ''}}> Rusak
                                    </label>
                                    @if ($errors->has('kondisi_segel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kondisi_segel') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('jumlah_jenis_barang_diperiksa') ? ' has-error' : '' }}">
                                <label for="jumlah_jenis_barang_diperiksa" class="col-md-2 control-label">Jumlah Jenis Barang yang diperiksa</label>

                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="jumlah_jenis_barang_diperiksa" value="{{$lhp->jumlah_jenis_barang_diperiksa}}">
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
                                                <th>Spesifikasi</th>
                                                <th>Negara Asal</th>
                                                <th>Keterangan</th>
                                                <th>Act</th>
                                            </thead>
                                            <tbody>
                                                @foreach($barangLhps as $barangLhp)
                                                <tr class="rowbaru">
                                                    <td class="count">{{$no++}}</td>
                                                    <td>
                                                        {{$barangLhp->jumlah_jenis_ukuran_kemasan}}
                                                    </td>
                                                    <td>
                                                        {{$barangLhp->uraian}}
                                                    </td>
                                                    <td>
                                                        {{$barangLhp->jumlah_satuan}}
                                                    </td>
                                                    <td>
                                                        {{$barangLhp->spesifikasi}}
                                                    </td>
                                                    <td>
                                                        {{$barangLhp->negara_asal}}
                                                    </td>
                                                    <td>
                                                        {{$barangLhp->keterangan}}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-xs btn-danger" href="{{route('lhp.detailBarangEdit', $barangLhp->id)}}">Edit</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>                                
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('kesimpulan') ? ' has-error' : '' }}">
                                <label for="kesimpulan" class="col-md-2 control-label">Kesimpulan</label>

                                <div class="col-md-10">
                                    <textarea class="form-control" rows="5" name="kesimpulan">{{$lhp->kesimpulan}}</textarea>

                                    @if ($errors->has('kesimpulan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kesimpulan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-group{{ $errors->has('hasil_pemeriksaan') ? ' has-error' : '' }}">
                                <label for="hasil_pemeriksaan" class="col-md-2 control-label">Photo</label>

                                <div class="col-md-10">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="row">
                                            <div class="col-md-12">
                                                @foreach($photos as $photo)
                                                <a href="{{asset("storage/lhp_photos/$photo->filename")}}" data-toggle="lightbox" data-gallery="foto_lhp" class="col-sm-4">
                                                    <img src="{{asset("storage/lhp_photos/$photo->filename")}}" class="img-responsive">
                                                </a>
                                                @endforeach
                                                <a style="margin: 20px 20px" class="btn btn-danger" href="{{route('lhp.photoEdit', $lhp->id)}}">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group{{ $errors->has('photos') ? ' has-error' : '' }}">
                                <label for="photos" class="col-md-2 control-label">Tambah Foto</label>

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
                            <hr>
                            <div class="form-group{{ $errors->has('jumlah_jenis_barang_diperiksa') ? ' has-error' : '' }}">
                                <label for="jumlah_jenis_barang_diperiksa" class="col-md-2 control-label">Pemeriksa</label>

                                <div class="col-md-10">
                                    <p>{{$lhp->pemeriksa_nama}} / {{$lhp->pemeriksa_nip}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-md-11">
                                <button type="submit" class="btn btn-primary pull-right" onclick="konfirm()">
                                    Simpan
                                </button>
                                <a style="margin-right: 5px;" class="btn btn-success pull-right" href="{{url()->previous()}}">Kembali</a>

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