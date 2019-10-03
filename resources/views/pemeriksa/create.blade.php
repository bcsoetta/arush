@extends('layouts.app')

@section('pageName')
Pemeriksa
@endsection

@section('styles')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> --}}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Pemeriksa</div>

                <div class="panel-body">
                    <form action="#" method="POST">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed table-borderless">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr >
                                    <th style="width:200px">1</th>
                                    <th style="width:200px">{{$user->name}}</th>
                                    <th style="width:200px">{{$user->nip}}</th>
                                    <td colspan="3">
                                        <select class="form-control {{ $errors->has('lokasi') ? 'salah' : '' }}" style=" width: 100%" name="lokasi" placeholder="pilih">
                                        {{-- <option value="{{$dokumenDetail->harga_jenis}}" selected>{{$dokumenDetail->harga_jenis}}</option> --}}
                                        @foreach($lokasi as $lok)
                                        <option value="{{$lok->id}}">{{$lok->nama}}</option>
                                        @endforeach
                                    
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                            
                        </table>
                    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection

