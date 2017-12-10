@extends('layouts.app')

@section('pageName')
LHP
@endsection

@section('styles')
<link href="{{ asset('css/ekko-lightbox.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title"><strong>Laporan Hasil pemeriksaan (LHP)</strong></h2>
    </div>
    <div class="panel-body">
        <div class="row">

            <div class="col-md-12">
                <h3>Laporan Hasil Pemeriksaan :</h3>
                <hr>
                {{-- <div class="row"> --}}
                    <form class="form-horizontal">

                        <div class="form-group{{ $errors->has('tgl_periksa') ? ' has-error' : '' }}" id="tgl">
                            <label for="tgl_periksa" class="col-md-2 control-label">Tanggal Periksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="tgl_periksa" value="{{$lhp->tgl_periksa}}">
                                @if ($errors->has('tgl_periksa'))
                                <span class="help-block">{{$lhp->tgl_periksa}}
                                    <strong>{{ $errors->first('tgl_periksa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jam_periksa') ? ' has-error' : '' }}">
                            <label for="jam_periksa" class="col-md-2 control-label">Jam Mulai Periksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="jam_periksa" placeholder="00:00" value="{{$lhp->jam_periksa}}">
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
                                <input type="text" class="form-control" name="jam_selesai" placeholder="00:00" value="{{$lhp->jam_selesai}}">
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
                                <input type="text" class="form-control" name="lokasi" value="{{$lhp->lokasi}}">
                                @if ($errors->has('lokasi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lokasi') }}</strong>
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
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div  class="table-responsive">
                                    <table class="table table-hover" id="hasil_periksa">
                                        <thead>
                                            <th>No</th>
                                            <th>Jumlah, Jenis, Ukuran Kemasan</th>
                                            <th>Uraian Barang</th>
                                            <th>Jumlah Satuan Barang</th>
                                            <th>Spesifikasi</th>
                                            <th>Negara Asal</th>
                                            <th>Keterangan</th>
                                            <th></th>
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
                                            @foreach($photos as $photo)
                                            <a href="{{asset("storage/lhp_photos/$photo->filename")}}" data-toggle="lightbox" data-gallery="foto_lhp" class="col-sm-4">
                                                <img src="{{asset("storage/lhp_photos/$photo->filename")}}" class="img-responsive">
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group{{ $errors->has('jumlah_jenis_barang_diperiksa') ? ' has-error' : '' }}">
                            <label for="jumlah_jenis_barang_diperiksa" class="col-md-2 control-label">Pemeriksa</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="jumlah_jenis_barang_diperiksa" value="{{$lhp->pemeriksa_nama}} / {{$lhp->pemeriksa_nip}}">
                                @if ($errors->has('jumlah_jenis_barang_diperiksa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_jenis_barang_diperiksa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </form>                        
                {{-- </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/ekko-lightbox.min.js') }}"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endsection