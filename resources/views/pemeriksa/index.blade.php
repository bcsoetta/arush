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
            <div class="panel panel-default">
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
                                <tr >
                                    <th style="width:200px">1</th>
                                    <th style="width:200px">Nama</th>
                                    <td colspan="3">
                                        <select class="form-control jenisharga {{ $errors->has('harga_jenis') ? 'salah' : '' }}" style=" width: 100%" name="harga_jenis" placeholder="pilih">
                                        {{-- <option value="{{$dokumenDetail->harga_jenis}}" selected>{{$dokumenDetail->harga_jenis}}</option> --}}
                                        <option value="CIF">CIF</option>
                                        <option value="FOB">FOB</option>
                                        <option value="C&F">C&amp;F</option>
                                        </select>
                                    </td>
                                </tr>
                                
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

