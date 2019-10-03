@extends('layouts.app') 
@section('pageName') Dokumen 
@endsection 
@section('styles')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<style>
    th {
        text-transform: uppercase;
    }
</style>
@endsection
@section('content') {{-- over view --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Berita Acara Jaminan Harian</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('cetak.storeJaminanHarian')}}" method='POST'>
                {{csrf_field()}}
                    <div class="form-group tgl {{ $errors->has('tgl_lapor') ? ' has-error' : '' }}">
                        <label for="">Tgl Pelaporan:</label>
                        <input type="text" class="form-control" id="" placeholder="" name="tgl_lapor">
                        @if ($errors->has('tgl_lapor'))
                            <span class="help-block">
                                {{ $errors->first('tgl_lapor') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('pelapor') ? ' has-error' : '' }}">
                        <label for="">Yang Melaporkan:</label>
                        <select class="form-control" id="pilih" name="pelapor">
                            <option value="" selected></option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('pelapor'))
                            <span class="help-block">
                                {{ $errors->first('pelapor') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('jabatan') ? ' has-error' : '' }}">
                        <label for="">Jabatan:</label>
                        <input type="text" class="form-control" id="" placeholder="" value="Pelaksana" name="jabatan">
                        @if ($errors->has('jabatan'))
                            <span class="help-block">
                                {{ $errors->first('jabatan') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('unit') ? ' has-error' : '' }}">
                        <label for="">Unit:</label>
                        <input type="text" class="form-control" id="" placeholder="" value="Seksi Pabean dan Cukai" name="unit">
                        @if ($errors->has('unit'))
                            <span class="help-block">
                                {{ $errors->first('unit') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group tgl {{ $errors->has('tgl_jaminan_awal') ? ' has-error' : '' }}">
                        <label for="">Tgl Jaminan Awal:</label>
                        <input type="text" class="form-control" id="" placeholder="" name="tgl_jaminan_awal">
                        @if ($errors->has('tgl_jaminan_awal'))
                            <span class="help-block">
                                {{ $errors->first('tgl_jaminan_awal') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group tgl {{ $errors->has('tgl_jaminan_akhir') ? ' has-error' : '' }}">
                        <label for="">Tgl Jaminan Akhir:</label>
                        <input type="text" class="form-control" id="" placeholder="" name="tgl_jaminan_akhir">
                        @if ($errors->has('tgl_jaminan_akhir'))
                            <span class="help-block">
                                {{ $errors->first('tgl_jaminan_akhir') }}
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </form>
            </div>

        </div>
        @if(count($ba) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" id="ba-jaminan">
                        <thead>
                            <tr>
                                <th>No BA</th>
                                <th>Tgl</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Tgl awal</th>
                                <th>Tgl akhir</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ba as $beritaAcara)
                            <tr>
                                <td style="text-align: center">{{$beritaAcara->nomor}}</td>
                                <td style="text-align: center">{{$beritaAcara->tgl_pelaporan}}</td>
                                <td>{{$beritaAcara->name}}</td>
                                <td style="text-align: center">{{$beritaAcara->nip}}</td>
                                <td style="text-align: center">{{$beritaAcara->tgl_jaminan_awal}}</td>
                                <td style="text-align: center">{{$beritaAcara->tgl_jaminan_akhir}}</td>
                                <td style="text-align: center">
                                    <a class="btn btn-xs btn-primary" href="{{route('cetak.cetakBaJaminan', $beritaAcara->id)}}">Cetak BA</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('cetak.cetakLampiranBa', $beritaAcara->id)}}">lampiran</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div> {{-- end-panel --}} 
@endsection 
@section('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.tgl input').datepicker({
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
</script>
<script>
    $('#ba-jaminan').DataTable({
        order: [ [1, 'desc'], [0, 'desc'] ]
    });

</script>
@endsection