$(document).ready(function(){
    $('#tgl_kurs').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $(".pilihhs").select2({
        placeholder: "Pilih",
        ajax:{
            url:'/api/hs',
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
    // $(".pilihhs").on('select2:select',function(e){
    //     alert(data.kd_trf_bm);
    //     // $('#trf_bm').val(data.data.kd_trf_bm);
    // });
    $(".pilihhs").on('change', function(e) {
        // Access to full data
        // console.log($(this).select2('data'));
        var data = $(this).select2('data');
        console.log(data[0].bm);
        $('#trf_bm').val(data[0].bm);
        $('#trf_ppn').val(data[0].ppn);
        $('#trf_ppnbm').val(data[0].ppnbm);
        $('#trf_pph').val(data[0].pph);
    });
    $(".pilih").select2({
        placeholder: "Pilih",
        allowClear: true,
        selectOnClose: true
    });
    $(".pilihkurs").select2({ 
        placeholder: "Pilih kurs",
        allowClear: true
    });
    $(".pilihkurs").on('change', function(e){
        var nilaiKurs = $('#pilihkurs').val();
        var inputKurs = $('#kurs').val(nilaiKurs);
        var kodeKurs = $('#pilihkurs option:selected').text();
        var inputKodeKurs = $('#kode_kurs').val(kodeKurs);

        console.log(kodeKurs);

    });
});