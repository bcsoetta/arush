{{-- @extends('layouts.app')

@section('pageName')
Dokumen
@endsection

@section('styles')

@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lembar Hasil Pemeriksaan</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('lhp.store', $dokumen->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('hasil_pemeriksaan') ? ' has-error' : '' }}">
                            <label for="hasil_pemeriksaan" class="col-md-2 control-label">Hasil Pemeriksaan</label>

                            <div class="col-md-10">
                                <textarea class="form-control" rows="8" name="hasil_pemeriksaan" autofocus></textarea>

                                @if ($errors->has('hasil_pemeriksaan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hasil_pemeriksaan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photos') ? ' has-error' : '' }}">
                            <label for="photos" class="col-md-2 control-label">Upload Foto</label>

                            <div class="col-md-10">
                                <input id="photo" type="file" class="form-control" name="photo[]" multiple>
                                @if ($errors->has('photos'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photos') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Simpan
                                </button>

                            </div>
                        </div>
                    </form>
                    {{-- <p><strong>{{ dd($errors) }}</strong></p> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection

 --}}