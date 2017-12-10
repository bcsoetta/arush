@extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Instruksi Pemeriksaan (IP)</div>

                <div class="panel-body">
                    <div class="row">
                        <a href="{{ route('dokumen.show', $dokumen->id)}}"><button class="btn btn-primary pull-right" style="margin: 10px">Kembali</button></a>                        
                    </div>
                    <div class="row">
                    <form class="form-horizontal" method="POST" action="{{ route('instruksi-pemeriksaan.store', $dokumen->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('pemeriksa') ? ' has-error' : '' }}">
                            <label for="user" class="col-md-4 control-label">Nama Pemeriksa</label>

                            <div class="col-md-6">
                                <select class="form-control" name="pemeriksa" id="pilih">
                                    <option value="{{$dokumen->pemeriksa_id}}" selected>{{$dokumen->pemeriksa_nama}} {{$dokumen->pemeriksa_nip}}</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} {{$user->nip}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('pemeriksa'))
                                <span class="help-block">
                                    {{ $errors->first('pemeriksa') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-8">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>

                            </div>
                        </div>
                    </form>                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $("#pilih").select2({
        placeholder: "Pilih",
        allowClear: true
    });
</script>

@endsection

