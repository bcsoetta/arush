@extends('layouts.app')

@section('pageName')
Isi daftar Hadir
@endsection

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Isi Daftar Waktu Kerja</div>
                <div class="panel-body">
                @if(Session::has('success'))
                    <div class="alert alert-info">
                        {{ session('success') }}
                    </div>
                @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        
                        <h4 class="col-md-12">Hari Tanggal : {{date('d-m-Y').' - '.auth()->user()->name}}</h4>
                        <br>
                        <form class="col-md-8 col-md-offset-1" method="POST" action="{{route('presensi.store')}}">
                        {{ csrf_field() }}
                            @foreach($waktuKerja as $jam)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="waktu_kerja" value="{{$jam->label}}">
                                    {{strtoupper($jam->label) . ' ' . $jam->waktu_mulai . ' sampai dengan '. $jam->waktu_selesai }}
                                </label>
                            </div>
                            @endforeach
                            <br>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <br>
                        <h4>Status:</h4>
                        <p>*Daftar ini tidak ada hubunganya dengan presensi ceisa</p>
                        <div class="table-responsive">

                            <table class="table table-bordered table-small mt-4" style="margin-top: 10px;">
                                <thead>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                </thead>
                                <tbody>
                                    @foreach($hadir as $data)
                                    <tr>
                                        <td class="text-center">{{$data->start->format('d-m-Y H:i:s')}}</td>
                                        <td class="text-center">{{$data->end->format('d-m-Y H:i:s')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection

