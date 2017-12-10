@extends('layouts.app')

@section('pageName')
    Rekam Detail Barang
@endsection

@section('styles')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<style>
    .tarif table input {
        text-align: right;
    }
</style>
@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-default">
    <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Edit Detail Barang</h3>
    </div>
    <div class="panel-body">
       <div class="row">
            <a href="{{ route('detail.index', $dokumenDetail->dokumen_id)}}"><button class="btn btn-primary pull-right" style="margin: 10px">Kembali</button></a>
        </div>
        <form method="POST" action="{{ route('detail.update', $dokumenDetail->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        {{-- parsial form --}}
        @include('partial._form_dokumen_detail_edit')
        </form>
    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
$(document).ready(function(){
    $(".pilihkurs").select2({
        placeholder: "Pilih",
        allowClear: true
    });

    $(".jenisharga").select2({
        placeholder: "Pilih",
        allowClear: true
    });

    $(".pilihkurs").on('change', function(e){
        var nilaiKurs = $('#pilihkurs').val();
        var nilaiKurslabel = $("#pilihkurs option:selected").text();
        var inputKurs = $('#kurs_nilai').val(nilaiKurs);
        var kurs_label = $('#kurs_label').val(nilaiKurslabel);
        console.log(inputKurs);
    });

    $('.pilihhs').append('<option value=someID>optionText</option>');

    $(".pilihhs").select2({
        placeholder: "Pilih",
        ajax:{
            url:'{{route('data.hs')}}',
            dataType: 'json',
            delay: 250,
            data: function(params){
                return {
                    q: params.term.replace(/\./g, ''),
                    page: params.page
                };
            },
            processResults:function(data, params){
                params.page = params.page || 1;
                return{
                    results: data.data,
                    pagination: {
                        more : (params.page * 10) < data.total
                    }
                };
            },
            cache: true
        },
        escapeMarkup : function(markup){return markup;},
        minimumInputLength: 1,
        templateResult : function(repo){
            if(repo.loading) return repo.id_hs_code;
            var markup = repo.hs_code + "&nbsp;"+repo.uraian;
            return markup;
        },
        templateSelection : function(repo)
        {
            return repo.hs_code;
        }
    });  

    $(".pilihhs").on('change', function(e) {
        // Access to full data
        // console.log($(this).select2('data'));
        var data = $(this).select2('data');
        var hs = data[0].id_hs_code;
        $('#hs').val(hs);
        $('#trf_bm').val(data[0].bm);
        $('#trf_ppn').val(data[0].ppn);
        $('#trf_ppnbm').val(data[0].ppnbm);
        $('#trf_pph').val(data[0].pph);
    });

    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        if (angka < 0) {
            alert('negatif');
        }
        
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   = number_string.split(','),
        sisa    = split[0].length % 3,
        rupiah  = split[0].substr(0, sisa),
        ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function convertToAngka(value)
    {
        //replace hilangkan semua titik
        var nilai = value.replace(/\./g,'');
        //replace koma dengan titk
        var nilai = parseFloat(nilai.replace(',','.'));
        return nilai;
    }

    // 
    $('#harga').keyup(function(){
        $('#harga').val(formatRupiah($('#harga').val()));
    });
    $('#freight').keyup(function(){
        $('#freight').val(formatRupiah($('#freight').val()));
    });
    $('#asuransi').keyup(function(){
        $('#asuransi').val(formatRupiah($('#asuransi').val()));
    });

    $('#ditanggung_pmrnth_bm').keyup(function(){
        $('#ditanggung_pmrnth_bm').val(formatRupiah($('#ditanggung_pmrnth_bm').val()));
    });

    $('#ditanggung_pmrnth_ppn').keyup(function(){
        $('#ditanggung_pmrnth_ppn').val(formatRupiah($('#ditanggung_pmrnth_ppn').val()));
    });

    $('#ditanggung_pmrnth_ppnbm').keyup(function(){
        $('#ditanggung_pmrnth_ppnbm').val(formatRupiah($('#ditanggung_pmrnth_ppnbm').val()));
    });

    $('#ditanggung_pmrnth_pph').keyup(function(){
        $('#ditanggung_pmrnth_pph').val(formatRupiah($('#ditanggung_pmrnth_pph').val()));
    });

    $('#ditangguhkan_bm').keyup(function(){
        $('#ditangguhkan_bm').val(formatRupiah($('#ditangguhkan_bm').val()));
    });
    $('#ditangguhkan_ppn').keyup(function(){
        $('#ditangguhkan_ppn').val(formatRupiah($('#ditangguhkan_ppn').val()));
    });
    $('#ditangguhkan_ppnbm').keyup(function(){
        $('#ditangguhkan_ppnbm').val(formatRupiah($('#ditangguhkan_ppnbm').val()));
    });
    $('#ditangguhkan_pph').keyup(function(){
        $('#ditangguhkan_pph').val(formatRupiah($('#ditangguhkan_pph').val()));
    });

    $('#dibebaskan_bm').keyup(function(){
        $('#dibebaskan_bm').val(formatRupiah($('#dibebaskan_bm').val()));
    });
    $('#dibebaskan_ppn').keyup(function(){
        $('#dibebaskan_ppn').val(formatRupiah($('#dibebaskan_ppn').val()));
    });
    $('#dibebaskan_ppnbm').keyup(function(){
        $('#dibebaskan_ppnbm').val(formatRupiah($('#dibebaskan_ppnbm').val()));
    });
    $('#dibebaskan_pph').keyup(function(){
        $('#dibebaskan_pph').val(formatRupiah($('#dibebaskan_pph').val()));
    });



    $(document).on('change', function(e){




        var harga = convertToAngka($('#harga').val());
        var freight = convertToAngka($('#freight').val());
        var asuransi = convertToAngka($('#asuransi').val());



        var cif = harga + freight + asuransi;
        $('#cif').val(formatRupiah(cif.toFixed(2).replace('.', ',')));

        var kurs = parseFloat($('#kurs_nilai').val());
        // $('#kurs_nilai').val(formatRupiah(kurs.toFixed(4).replace('.', ',')));

        var nilai_pabean = Math.round(cif * kurs);
        $('#nilai_pabean').val(formatRupiah(nilai_pabean.toFixed(2).replace('.', ',')));

        var trf_bm = convertToAngka($('#trf_bm').val());
        var trf_ppn = convertToAngka($('#trf_ppn').val());
        var trf_ppnbm = convertToAngka($('#trf_ppnbm').val());
        var trf_pph = convertToAngka($('#trf_pph').val());

        var ditanggung_pmrnth_bm = convertToAngka($('#ditanggung_pmrnth_bm').val());
        var ditanggung_pmrnth_ppn = convertToAngka($('#ditanggung_pmrnth_ppn').val());
        var ditanggung_pmrnth_ppnbm = convertToAngka($('#ditanggung_pmrnth_ppnbm').val());
        var ditanggung_pmrnth_pph = convertToAngka($('#ditanggung_pmrnth_pph').val());

        var ditangguhkan_bm = convertToAngka($('#ditangguhkan_bm').val());
        var ditangguhkan_ppn = convertToAngka($('#ditangguhkan_ppn').val());
        var ditangguhkan_ppnbm = convertToAngka($('#ditangguhkan_ppnbm').val());
        var ditangguhkan_pph = convertToAngka($('#ditangguhkan_pph').val());

        var dibebaskan_bm = convertToAngka($('#dibebaskan_bm').val());
        var dibebaskan_ppn = convertToAngka($('#dibebaskan_ppn').val());
        var dibebaskan_ppnbm = convertToAngka($('#dibebaskan_ppnbm').val());
        var dibebaskan_pph = convertToAngka($('#dibebaskan_pph').val());


        //hitung BM
        var bayar_bm = Math.round((trf_bm /100) * nilai_pabean);
        var nilaiBm = bayar_bm;

        //BM + nilai pabean
        nilaiHitungPajak =  Math.round(nilai_pabean + nilaiBm);

        bayar_bm = bayar_bm - ditanggung_pmrnth_bm;
        bayar_bm = bayar_bm - ditangguhkan_bm;
        bayar_bm = bayar_bm - dibebaskan_bm

        var bayar_ppn = Math.round((trf_ppn / 100)* nilaiHitungPajak);
        bayar_ppn = bayar_ppn - ditanggung_pmrnth_ppn;
        bayar_ppn = bayar_ppn - ditangguhkan_ppn;
        bayar_ppn = bayar_ppn - dibebaskan_ppn;

        var bayar_ppnbm = Math.round((trf_ppnbm / 100) * nilaiHitungPajak);
        bayar_ppnbm = bayar_ppnbm - ditanggung_pmrnth_ppnbm;
        bayar_ppnbm = bayar_ppnbm - ditangguhkan_ppnbm;
        bayar_ppnbm = bayar_ppnbm - dibebaskan_ppnbm;


        var bayar_pph = Math.round((trf_pph / 100) * nilaiHitungPajak);
        bayar_pph = bayar_pph - ditanggung_pmrnth_pph;
        bayar_pph = bayar_pph - ditangguhkan_pph;
        bayar_pph = bayar_pph - dibebaskan_pph;

        var ditanggung_pmrnth_total = ditanggung_pmrnth_bm + ditanggung_pmrnth_ppn + ditanggung_pmrnth_ppnbm + ditanggung_pmrnth_pph;
        var ditangguhkan_total = ditangguhkan_bm + ditangguhkan_ppn + ditangguhkan_ppnbm + ditangguhkan_pph;
        var dibebaskan_total = dibebaskan_bm + dibebaskan_ppn + dibebaskan_ppnbm + dibebaskan_pph;
        var bayar_total = bayar_bm + bayar_ppn + bayar_ppnbm + bayar_pph;

        //add to input
        $('#trf_bm').val(formatRupiah(trf_bm.toFixed(1).replace('.', ',')));
        $('#trf_ppn').val(formatRupiah(trf_ppn.toFixed(1).replace('.', ',')));
        $('#trf_ppnbm').val(formatRupiah(trf_ppnbm.toFixed(1).replace('.', ',')));
        $('#trf_pph').val(formatRupiah(trf_pph.toFixed(1).replace('.', ',')));

        $('#ditanggung_pmrnth_total').val(formatRupiah(ditanggung_pmrnth_total.toFixed(2).replace('.', ',')));
        $('#ditangguhkan_total').val(formatRupiah(ditangguhkan_total.toFixed(2).replace('.', ',')));
        $('#dibebaskan_total').val(formatRupiah(dibebaskan_total.toFixed(2).replace('.', ',')));

        $('#bayar_bm').val(formatRupiah(bayar_bm.toFixed(2).replace('.', ',')));
        $('#bayar_ppn').val(formatRupiah(bayar_ppn.toFixed(2).replace('.', ',')));
        $('#bayar_ppnbm').val(formatRupiah(bayar_ppnbm.toFixed(2).replace('.', ',')));
        $('#bayar_pph').val(formatRupiah(bayar_pph.toFixed(2).replace('.', ',')));
        $('#bayar_pph').val(formatRupiah(bayar_pph.toFixed(2).replace('.', ',')));
        $('#bayar_total').val(formatRupiah(bayar_total.toFixed(2).replace('.', ',')));

        console.log(ditanggung_pmrnth_bm);
        console.log(ditanggung_pmrnth_ppn);
        console.log(ditanggung_pmrnth_ppnbm);
        console.log(ditanggung_pmrnth_pph);

    });
});



</script>
@endsection
