@extends('layouts.app')

@section('pageName')
Detail Dokumen
@endsection

@section('styles')
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title"><strong>Dokumen Lengkap</strong></h2>
    </div>
    <div class="panel-body">
        {{-- parsial --}}
        @include('partial.panel')
        <div class="row">
            <div class="col-md-12">
                @include('partial.header-dokumen')
                <h3>
                    Detail Barang :
                </h3>
                
                <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed table-borderless">
                        <thead></thead>
                            <tbody>
                                <tr>
                                    <th style="width:200px">URAIAN BARANG</th>
                                    <td colspan="2">
                                        <textarea class="form-control" name="uraian_barang" rows="2" readonly>{{$dokumenDetail->uraian_barang}}</textarea>
                                    </td>                    
                                </tr>
                                <tr >
                                    <th style="width:200px">JUMLAH</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="kemasan_jumlah" value="{{$dokumenDetail->kemasan_jumlah}} {{$dokumenDetail->kemasan_jenis}}" readonly>
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">NEGARA ASAL</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="kemasan_jumlah" value="{{$dokumenDetail->negara_asal}}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">HS</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="hs_code" value="{{$dokumenDetail->hs_code}}" readonly>
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">JENIS HARGA</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="harga_jenis" id="harga" value="{{$dokumenDetail->harga_jenis}}" readonly>
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">HARGA</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="harga_barang" id="harga" value="{{$dokumenDetail->harga_barang}}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">FREIGHT</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="freight" id="freight" value="{{$dokumenDetail->freight}}" readonly>
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">ASURANSI</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="asuransi" id="asuransi" value="{{$dokumenDetail->asuransi}}" readonly>
                                    </td>                    
                                </tr>
                                <tr >
                                    <th style="width:200px">CIF</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="cif" id="cif" readonly value="{{$dokumenDetail->cif}}" readonly>
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">KURS</th>
                                    <td><input type="text" class="form-control" id="kurs_nilai" name="kurs_nilai" value="{{number_format($dokumenDetail->kurs_nilai,1,",",".")}} {{$dokumenDetail->kurs_label}}" readonly></td>
                                </tr>
                                <tr>
                                    <th style="width:200px">NILAI PABEAN</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="nilai_pabean" id="nilai_pabean" value="{{$dokumenDetail->nilai_pabean}}" readonly>
                                    </td>                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive tarif">
                        <table class="table table-hover table-striped table-highlight">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th style="width:20px">TARIF (%)</th>
                                    <th>DIBAYAR (Rp)</th>
                                    <th>DITANGGUNG PEMERINTAH (Rp)</th>
                                    <th>DITANGGUHKAN (Rp)</th>
                                    <th>DIBEBASKAN (Rp)</th>
                                </tr>
                                <tr>
                                    <th>BM</th>
                                    <td>
                                        <input type="text" class="form-control" style="width:55px" name="trf_bm" id="trf_bm" value="{{$dokumenDetail->trf_bm}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="bayar_bm" value="{{$dokumenDetail->bayar_bm}}" id="bayar_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditanggung_pmrnth_bm" value="{{$dokumenDetail->ditanggung_pmrnth_bm}}" id="ditanggung_pmrnth_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditangguhkan_bm" value="{{$dokumenDetail->ditangguhkan_bm}}" id="ditangguhkan_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="dibebaskan_bm" value="{{$dokumenDetail->dibebaskan_bm}}" id="dibebaskan_bm">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <td>
                                        <input type="text" class="form-control" style="width:55px" name="trf_ppn" value="{{$dokumenDetail->trf_ppn}}" id="trf_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="bayar_ppn" value="{{$dokumenDetail->bayar_ppn}}" id="bayar_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditanggung_pmrnth_ppn" value="{{$dokumenDetail->ditanggung_pmrnth_ppn}}" id="ditanggung_pmrnth_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditangguhkan_ppn" value="{{$dokumenDetail->ditangguhkan_ppn}}" id="ditangguhkan_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="dibebaskan_ppn" value="{{$dokumenDetail->dibebaskan_ppn}}" id="dibebaskan_ppn">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPNBM</th>
                                    <td>
                                        <input type="text" class="form-control" style="width:55px" name="trf_ppnbm" value="{{$dokumenDetail->trf_ppnbm}}" id="trf_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="bayar_ppnbm" value="{{$dokumenDetail->bayar_ppnbm}}" id="bayar_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditanggung_pmrnth_ppnbm" value="{{$dokumenDetail->ditanggung_pmrnth_ppnbm}}" id="ditanggung_pmrnth_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditangguhkan_ppnbm" value="{{$dokumenDetail->ditangguhkan_ppnbm}}" id="ditangguhkan_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="dibebaskan_ppnbm" value="{{$dokumenDetail->dibebaskan_ppnbm}}" id="dibebaskan_ppnbm">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPH</th>
                                    <td>
                                        <input type="text" class="form-control" style="width:55px" name="trf_pph" value="{{$dokumenDetail->trf_pph}}" id="trf_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="bayar_pph" value="{{$dokumenDetail->bayar_pph}}" id="bayar_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditanggung_pmrnth_pph" value="{{$dokumenDetail->ditanggung_pmrnth_pph}}" id="ditanggung_pmrnth_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ditangguhkan_pph" value="{{$dokumenDetail->ditangguhkan_pph}}" id="ditangguhkan_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="dibebaskan_pph" value="{{$dokumenDetail->dibebaskan_pph}}" id="dibebaskan_pph">
                                    </td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$dokumenDetail->bayar_total}}" name="bayar_total" id="bayar_total">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$dokumenDetail->ditanggung_pmrnth_total}}" name="ditanggung_pmrnth_total" id="ditanggung_pmrnth_total">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$dokumenDetail->ditangguhkan_total}}" name="ditangguhkan_total" id="ditangguhkan_total">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$dokumenDetail->dibebaskan_total}}" name="dibebaskan_total" id="dibebaskan_total">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div> {{-- end-panel --}}

@endsection

@section('scripts')
{{-- <script src="//code.jquery.com/jquery-1.12.3.js"></script> --}}
@endsection