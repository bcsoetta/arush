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
<div class="panel panel-primary">
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
    // function formatRupiah(angka, prefix)
    // {
    //     if (angka < 0) {
    //         alert('negatif');
    //     }
        
    //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //     split   = number_string.split(','),
    //     sisa    = split[0].length % 3,
    //     rupiah  = split[0].substr(0, sisa),
    //     ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

    //     if (ribuan) {
    //         separator = sisa ? '.' : '';
    //         rupiah += separator + ribuan.join('.');
    //     }

    //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    //     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    // }

    function convertToAngka(value)
    {
        //replace hilangkan semua titik
        var nilai = value.replace(/\./g,'');
        //replace koma dengan titk
        var nilai = parseFloat(nilai.replace(',','.'));
        return nilai;
    }

    $('#harga').keyup(function(){
        $('#harga').val($('#harga').val().replace(/[^.\d]/g, ''));
    });

    $('#freight').keyup(function(){
        $('#freight').val($('#freight').val().replace(/[^.\d]/g, ''));
    });

    $('#asuransi').keyup(function(){
        $('#asuransi').val($('#asuransi').val().replace(/[^.\d]/g, ''));
    });

    $(document).on('change', function(e){

        var harga = parseFloat($('#harga').val());
        var freight = parseFloat($('#freight').val());
        var asuransi = parseFloat($('#asuransi').val());

        var cif = harga + freight + asuransi;
        $('#cif').val(cif.toFixed(4));

        var kurs = parseFloat($('#kurs_nilai').val());

        var nilai_pabean = cif * kurs;
        $('#nilai_pabean').val(nilai_pabean.toFixed(4));

        var trf_bm = parseFloat($('#trf_bm').val());
        var trf_ppn = parseFloat($('#trf_ppn').val());
        var trf_ppnbm = parseFloat($('#trf_ppnbm').val());
        var trf_pph = parseFloat($('#trf_pph').val());

        var ditanggung_pmrnth_bm = parseFloat($('#ditanggung_pmrnth_bm').val());
        var ditanggung_pmrnth_ppn = parseFloat($('#ditanggung_pmrnth_ppn').val());
        var ditanggung_pmrnth_ppnbm = parseFloat($('#ditanggung_pmrnth_ppnbm').val());
        var ditanggung_pmrnth_pph = parseFloat($('#ditanggung_pmrnth_pph').val());

        var ditangguhkan_bm = parseFloat($('#ditangguhkan_bm').val());
        var ditangguhkan_ppn = parseFloat($('#ditangguhkan_ppn').val());
        var ditangguhkan_ppnbm = parseFloat($('#ditangguhkan_ppnbm').val());
        var ditangguhkan_pph = parseFloat($('#ditangguhkan_pph').val());

        var dibebaskan_bm = parseFloat($('#dibebaskan_bm').val());
        var dibebaskan_ppn = parseFloat($('#dibebaskan_ppn').val());
        var dibebaskan_ppnbm = parseFloat($('#dibebaskan_ppnbm').val());
        var dibebaskan_pph = parseFloat($('#dibebaskan_pph').val());


        //hitung BM
        var dbm = (trf_bm /100) * nilai_pabean;
        var bayar_bm = (Math.ceil(dbm/1000)) * 1000;
        var nilaiBm = bayar_bm;

        //BM + nilai pabean
        nilaiImpor =  nilai_pabean + nilaiBm;

        bayar_bm = bayar_bm - ditanggung_pmrnth_bm;
        bayar_bm = bayar_bm - ditangguhkan_bm;
        bayar_bm = bayar_bm - dibebaskan_bm;

        var dppn = (trf_ppn / 100) * nilaiImpor
        var bayar_ppn = Math.ceil(dppn/1000)*1000;
        bayar_ppn = bayar_ppn - ditanggung_pmrnth_ppn;
        bayar_ppn = bayar_ppn - ditangguhkan_ppn;
        bayar_ppn = bayar_ppn - dibebaskan_ppn;

        var dppnbm = (trf_ppnbm / 100) * nilaiImpor
        var bayar_ppnbm = Math.ceil(dppnbm/1000)*1000;
        bayar_ppnbm = bayar_ppnbm - ditanggung_pmrnth_ppnbm;
        bayar_ppnbm = bayar_ppnbm - ditangguhkan_ppnbm;
        bayar_ppnbm = bayar_ppnbm - dibebaskan_ppnbm;

        var dpph = (trf_pph / 100) * nilaiImpor
        var bayar_pph = Math.ceil(dpph/1000)*1000;
        bayar_pph = bayar_pph - ditanggung_pmrnth_pph;
        bayar_pph = bayar_pph - ditangguhkan_pph;
        bayar_pph = bayar_pph - dibebaskan_pph;

        var ditanggung_pmrnth_total = ditanggung_pmrnth_bm + ditanggung_pmrnth_ppn + ditanggung_pmrnth_ppnbm + ditanggung_pmrnth_pph;
        var ditangguhkan_total = ditangguhkan_bm + ditangguhkan_ppn + ditangguhkan_ppnbm + ditangguhkan_pph;
        var dibebaskan_total = dibebaskan_bm + dibebaskan_ppn + dibebaskan_ppnbm + dibebaskan_pph;
        var bayar_total = bayar_bm + bayar_ppn + bayar_ppnbm + bayar_pph;


        //add to input
        // $('#trf_bm').val(formatRupiah(trf_bm.toFixed(1).replace('.', ',')));
        // $('#trf_ppn').val(formatRupiah(trf_ppn.toFixed(1).replace('.', ',')));
        // $('#trf_ppnbm').val(formatRupiah(trf_ppnbm.toFixed(1).replace('.', ',')));
        // $('#trf_pph').val(formatRupiah(trf_pph.toFixed(1).replace('.', ',')));

        $('#ditanggung_pmrnth_total').val(ditanggung_pmrnth_total.toFixed(0));
        $('#ditangguhkan_total').val(ditangguhkan_total.toFixed(0));
        $('#dibebaskan_total').val(dibebaskan_total.toFixed(0));

        $('#bayar_bm').val(bayar_bm.toFixed(0));
        if(bayar_bm < 0){
            $('#bayar_bm').val(bayar_bm);
        }
        $('#bayar_ppn').val(bayar_ppn.toFixed(0));
        if(bayar_ppn < 0){
            $('#bayar_ppn').val(bayar_ppn);
        }

        $('#bayar_ppnbm').val(bayar_ppnbm.toFixed(0));
        if(bayar_ppnbm < 0){
            $('#bayar_ppnbm').val(bayar_ppnbm);
        }

        $('#bayar_pph').val(bayar_pph.toFixed(0));
        if(bayar_pph < 0){
            $('#bayar_pph').val(bayar_pph);
        }

        $('#bayar_pph').val(bayar_pph.toFixed(0));
        if(bayar_pph < 0){
            $('#bayar_pph').val(bayar_pph);
        }

        $('#bayar_total').val(bayar_total.toFixed(0));
        if(bayar_total < 0){
            $('#bayar_total').val(bayar_total);
        }

    });
});



</script>
@endsection
