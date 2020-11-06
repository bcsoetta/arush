@extends('layouts.app')

@section('pageName')
Rekam Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

{{-- over view --}}

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Blokir</h3>
    </div>
    <div class="panel-body">
        @can("CREATE-DOKUMEN")
        <a href="{{ url()->previous() }}"><button class="btn btn-primary" style="margin: 15px; margin-left: 0px;">Kembali</button></a>
        @endcan
        @if(isset($dokumen) AND count($dokumen) > 0)
        <div class="row">
            <div class="col-md-12">
                <h3>Blokir Automatis :</h3>
                <h5><strong>Mohon melakukan perekaman PIB/PIBK Definitif</strong></h5>
                <p></p>
                <hr>
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor RH</th>
                                <th>Tgl</th>
                                <th>Importir</th>
                                <th>PPJK</th>
                                <th>HAWB</th>
                                <th>Tgl</th>
                                <th>SPPB</th>
                                <th>Tgl</th>
                                <th>Waktu keluar</th>
                                <th>Berlalu(hari)</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokumen as $doc)
                            <tr class="{{$doc->selisih_hari > 3 ? 'danger': ''}}">
                                <td style="text-align: center">{{$doc->daftar_no}}</td>
                                <td style="text-align: center">{{$doc->daftar_tgl}}</td>
                                <td>{{$doc->importir_nm}}</td>
                                <td>{{$doc->ppjk_nm}}</td>
                                <td>{{$doc->hawb_no}}</td>
                                <td>{{$doc->hawb_tgl}}</td>
                                <td style="text-align: center">{{$doc->sppb->no_sppb}}</td>
                                <td style="text-align: center">{{$doc->sppb->created_at}}</td>
                                <td style="text-align: center">{{$doc->sppb->waktu_keluar}}</td>
                                <td style="text-align: center">{{$doc->selisih_hari}}</td>
                                <td style="text-align: center">
                                    <a class='btn btn-primary btn-xs' href="{{route('dokumen.show', $doc->id)}}">Detail</a>
                                    <a class='btn btn-danger btn-xs' href="{{route('pendok.create', $doc->id)}}">Rekam PIB/PIBK</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        @if(isset($blokir) AND count($blokir) > 0)
        <div class="row">
            <div class="col-md-12">
                <h3>Blokir Khusus :</h3>
                <h5>
                    <strong>Karena alasan tertentu</strong>
                </h5>
                <hr>
                <div class="table-responsive">
                    <table id="users-table" class="table table-condensed table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Identitas</th>
                                <th>No Surat</th>
                                <th>Hal</th>
                                <th>Alasan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blokir as $data)
                            <tr>
                                <td>1</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->no_identitas}}</td>
                                <td>{{$data->nomor_surat}}</td>
                                <td>{{$data->hal}}</td>
                                <td>{{$data->keterangan}}</td>
                                <td>{{$data->blokir === 'Y' ? 'BLOKIR' : 'TIDAK'}}</td>
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
</script>
@endsection