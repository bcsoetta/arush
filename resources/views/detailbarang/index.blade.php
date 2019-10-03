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
                    @can('CREATE-DETAIL')
                    @if($dokumen->status_id > 1 AND auth()->user()->hasRole('PENGGUNA-JASA'))
                    @else
                        @if($dokumen->status_id <= 4)
                        <a href="{{route('detail.create', $dokumen->id)}}"><button class="btn btn-primary pull-right">Tambah Detail Barang</button></a>
                        @endif
                    @endif
                    @endcan
                </h3>
                
                <br>
                <table id="table" class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th >No</th>
                            <th >Hs Code</th>
                            <th >Uraian</th>
                            <th >Jumlah</th>
                            <th >CIF</th>
                            <th  colspan="2">Kurs</th>
                            <th >Nilai Pabean (Rp.)</th>
                            <th >Act</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokumen->detail as $item)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td style="text-align: center">{{$item->hs_code}}</td>
                            <td style="text-align: center">{{$item->uraian_barang}}</td>
                            <td style="text-align: center">{{$item->kemasan_jumlah}} {{$item->kemasan_jenis}}</td>
                            <td style="text-align: right">{{$item->cif}}</td>
                            <td style="text-align: right">{{str_limit($item->kurs_label,4)}}</td>
                            <td style="text-align: right">{{number_format($item->kurs_nilai,1,",",".")}}</td>
                            <td style="text-align: right">{{$item->nilai_pabean}}</td>
                            <td style="text-align: center">
                                <a class="btn btn-primary btn-xs" href="{{ route('detail.show', $item->id)}}">Show</a>
                                @can('EDIT-DETAIL')
                                @if($dokumen->status_id <= 1 AND auth()->user()->hasRole('PENGGUNA-JASA'))
                                <a class="btn btn-danger btn-xs" href="{{ route('detail.edit', $item->id)}}">Edit</a>
                                @endif
                                @if($dokumen->status_id <= 4 AND !auth()->user()->hasRole('PENGGUNA-JASA'))
                                <a class="btn btn-danger btn-xs" href="{{ route('detail.edit', $item->id)}}">Edit</a>
                                @endif
                                @endcan
                                {{-- | 
                                <a href="{{ route('dokumen.show', $item->id)}}" 
                                    onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();">Hapus</a>
                                    <form id="delete-form" action="{{ route('detail.destroy', $item->id)}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> {{-- end-panel --}}

@endsection

@section('scripts')
{{-- <script src="//code.jquery.com/jquery-1.12.3.js"></script> --}}
@endsection