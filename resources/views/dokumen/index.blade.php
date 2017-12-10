@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
@endsection

@section('content')

{{-- over view --}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Dokumen</h3>
    </div>
    <div class="panel-body">
        @can("CREATE-DOKUMEN")
            <a href="{{ route('dokumen.create')}}"><button class="btn btn-primary pull-right" style="margin: 10px">Rekam Dokumen</button></a>
        @endcan
        <table id="" class="table table-condensed table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Importir</th>
                    <th>Ppjk</th>
                    <th>HAWB</th>
                    <th>Setatus</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dokumen as $dok)
                <tr>
                    <td>{{$dok->daftar_no}}</td>
                    <td>{{$dok->daftar_tgl}}</td>
                    <td>{{$dok->importir_nm}}</td>
                    <td>{{$dok->ppjk_nm}}</td>
                    <td>{{$dok->hawb_no}}</td>
                    <td>{{$dok->status_label}}</td>
                    <td style="text-align: center;">
                    <a class="btn btn-primary btn-xs" href="{{ route('dokumen.show', $dok->id)}}">Detail</a>&nbsp;
{{--                     <a class="btn btn-danger btn-xs" href="{{ route('dokumen.destroy', $dok->id)}}" 
                        onclick="event.preventDefault();
                        document.getElementById('delete-form').submit();">Hapus</a>
                        <form id="delete-form" action="{{ route('dokumen.destroy', $dok->id)}}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right">{{ $dokumen->links() }}</div>
    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')

@endsection

