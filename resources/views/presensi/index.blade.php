@extends('layouts.app')

@section('pageName')
Setting
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Absesni</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('setting.update') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                <label for="code" class="col-md-4 control-label">Blokir</label>

                <div class="col-md-6">
                    <label class="radio-inline">
                        <input type="radio" name="blokir" value="Y" {{$sett->blokir == 'Y' ? "checked":""}}>ON
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="blokir" value="N" {{$sett->blokir == 'N' ? "checked":""}}>OFF
                    </label>
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                        

            <div class="form-group">
                <div class="col-md-8 col-md-offset-6">
                    <button type="submit" class="btn btn-primary">
                        Absensi
                    </button>

                </div>
            </div>
        </form>
    </div>
</div> {{-- end-panel --}}
@endsection