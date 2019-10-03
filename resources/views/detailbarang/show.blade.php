@extends('layouts.app')

@section('pageName')
Detail Dokumen
@endsection

@section('styles')
@endsection

@section('content')
<div class="panel panel-primary">
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
                                        <input type="text" class="form-control" name="harga_barang" id="harga" value="{{number_format($dokumenDetail->harga_barang,2,',','.')}}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">FREIGHT</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="freight" id="freight" value="{{number_format($dokumenDetail->freight,2,',','.')}}" readonly>
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">ASURANSI</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="asuransi" id="asuransi" value="{{number_format($dokumenDetail->asuransi,2,',','.')}}" readonly>
                                    </td>                    
                                </tr>
                                <tr >
                                    <th style="width:200px">CIF</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="cif" id="cif" readonly value="{{number_format($dokumenDetail->cif,2,',','.')}}" readonly>
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">KURS</th>
                                    <td><input type="text" class="form-control" id="kurs_nilai" name="kurs_nilai" value="{{number_format($dokumenDetail->kurs_nilai,2,",",".")}} {{$dokumenDetail->kurs_label}}" readonly></td>
                                </tr>
                                <tr>
                                    <th style="width:200px">NILAI PABEAN</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="nilai_pabean" id="nilai_pabean" value="{{number_format($dokumenDetail->nilai_pabean,2,',','.')}}" readonly>
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
                                        <input type="text" class="form-control" style="width:55px" name="trf_bm" id="trf_bm" value="{{$dokumenDetail->trf_bm}}" readonly>
                                    </td>
                                    <td >
                                        <input type="text" class="form-control text-right" name="bayar_bm" value="{{number_format($dokumenDetail->bayar_bm,0,',','.')}}" id="bayar_bm" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditanggung_pmrnth_bm" value="{{number_format($dokumenDetail->ditanggung_pmrnth_bm,0,',','.')}}" id="ditanggung_pmrnth_bm" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditangguhkan_bm" value="{{number_format($dokumenDetail->ditangguhkan_bm,0,',','.')}}" id="ditangguhkan_bm" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="dibebaskan_bm" value="{{number_format($dokumenDetail->dibebaskan_bm,0,',','.')}}" id="dibebaskan_bm" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <td>
                                        <input type="text" class="form-control" style="width:55px" name="trf_ppn" value="{{$dokumenDetail->trf_ppn}}" id="trf_ppn" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="bayar_ppn" value="{{number_format($dokumenDetail->bayar_ppn,0,',','.')}}" id="bayar_ppn" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditanggung_pmrnth_ppn" value="{{number_format($dokumenDetail->ditanggung_pmrnth_ppn,0,',','.')}}" id="ditanggung_pmrnth_ppn" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditangguhkan_ppn" value="{{number_format($dokumenDetail->ditangguhkan_ppn,0,',','.')}}" id="ditangguhkan_ppn" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="dibebaskan_ppn" value="{{number_format($dokumenDetail->dibebaskan_ppn,0,',','.')}}" id="dibebaskan_ppn" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPNBM</th>
                                    <td>
                                        <input type="text" class="form-control" style="width:55px" name="trf_ppnbm" value="{{$dokumenDetail->trf_ppnbm}}" id="trf_ppnbm" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="bayar_ppnbm" value="{{number_format($dokumenDetail->bayar_ppnbm,0,',','.')}}" id="bayar_ppnbm" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditanggung_pmrnth_ppnbm" value="{{number_format($dokumenDetail->ditanggung_pmrnth_ppnbm,0,',','.')}}" id="ditanggung_pmrnth_ppnbm" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditangguhkan_ppnbm" value="{{number_format($dokumenDetail->ditangguhkan_ppnbm,0,',','.')}}" id="ditangguhkan_ppnbm" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="dibebaskan_ppnbm" value="{{number_format($dokumenDetail->dibebaskan_ppnbm,0,',','.')}}" id="dibebaskan_ppnbm" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPH</th>
                                    <td>
                                        <input type="text" class="form-control" style="width:55px" name="trf_pph" value="{{$dokumenDetail->trf_pph}}" id="trf_pph" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="bayar_pph" value="{{number_format($dokumenDetail->bayar_pph,0,',','.')}}" id="bayar_pph" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditanggung_pmrnth_pph" value="{{number_format($dokumenDetail->ditanggung_pmrnth_pph,0,',','.')}}" id="ditanggung_pmrnth_pph" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="ditangguhkan_pph" value="{{number_format($dokumenDetail->ditangguhkan_pph,0,',','.')}}" id="ditangguhkan_pph" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="dibebaskan_pph" value="{{number_format($dokumenDetail->dibebaskan_pph,0,',','.')}}" id="dibebaskan_pph" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control text-right" value="{{number_format($dokumenDetail->bayar_total,0,',','.')}}" name="bayar_total" id="bayar_total" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" value="{{number_format($dokumenDetail->ditanggung_pmrnth_total,0,',','.')}}" name="ditanggung_pmrnth_total" id="ditanggung_pmrnth_total" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" value="{{number_format($dokumenDetail->ditangguhkan_total,0,',','.')}}" name="ditangguhkan_total" id="ditangguhkan_total" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" value="{{number_format($dokumenDetail->dibebaskan_total,0,',','.')}}" name="dibebaskan_total" id="dibebaskan_total" readonly>
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