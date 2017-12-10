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
            <div class="panel-heading">Penerimaan Dokumen RH</div>
            <div class="panel-body">
                <form class="form-horizontal" method="GET" action="{{ route('pendok.search')}}">
                    <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}" id="tgl">

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="search" placeholder="cari nomor daftar, AWB, importir, ppjk">
                            @if ($errors->has('search'))
                            <span class="help-block">
                                <strong>{{ $errors->first('search') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
@endsection