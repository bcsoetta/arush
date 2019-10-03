@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Perekaman Pengeluaran Barang</div>
            <div class="panel-body">
                <form class="form-horizontal" method="GET" action="{{ route('gateout.search')}}">
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

@if(count($dokumen) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Dokumen</div>
            <div class="panel-body">
                <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No Daftar</th>
                            <th>Importir</th>
                            <th>PPJK</th>
                            <th>MAWB</th>
                            <th>HAWB</th>
                            <th>Status</th>
                            <th>ACT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokumen as $data)
                        
                        <tr>
                            <td>{{$data->daftar_no}}</td>
                            <td>{{$data->importir_nm}}</td>
                            <td>{{$data->ppjk_nm}}</td>
                            <td>{{$data->mawb_no}}</td>
                            <td>{{$data->hawb_no}}</td>
                            <td>{{$data->status_label}}</td>
                            @if($data->status_id == 5)
                            <td style="text-align: center">
                                <a class="btn btn-danger btn-xs" href="{{ route('gateout.create', $data->id)}}">Proses Pengeluaran</a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Dokumen</div>
            <div class="panel-body">
                <p>Tidak ketemu</p>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
@endsection