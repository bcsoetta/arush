@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Pencarian</div>
            <div class="panel-body">
                <form class="form-horizontal" method="GET" action="{{ route('search.index')}}">
                    <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}" id="tgl">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="search" placeholder="cari nomor daftar, AWB, importir, ppjk" id="search">
                            @if ($errors->has('search'))
                            <span class="help-block">
                                <strong>{{ $errors->first('search') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dokumen</div>
            <div class="panel-body">
                <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No Daftar</th>
                            <th>Importir</th>
                            <th>PPJK</th>
                            <th>HAWB</th>
                            <th>SETATUS</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    $('#search').on('keyup',function(){

        $value=$(this).val();

        $.ajax({
            type : 'get',
            url : '{{route('search.data')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);
            }
        });
    })

</script>
@endsection