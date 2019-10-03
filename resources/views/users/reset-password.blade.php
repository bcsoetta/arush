@extends('layouts.app')
@section('pageName')
Reset
@endsection

@section('style')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">{!! Session::get('success') !!}</div>
                @endif
                @if (Session::has('failure'))
                    <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
                @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('reset-password.store') }}">
                            {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}" >
                            <label for="user_name" class="col-md-4 control-label">Pilih User</label>

                            <div class="col-md-6">
                                <select class="form-control" name="user_name" required="" id="user_name">
                                    <option selected></option>
                                    @foreach($user as $use)
                                    <option value="{{$use->id}}">{{$use->name}}</option>
                                    @endforeach                                  

                                </select>

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-danger pull-right">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-info">
                        <p>Password akan direset menjadi '123456' (tanpa tanda petik)</p>
                    </div>
                </div>
 
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('js/select2.min.js') }}"></script>

<script type="text/javascript">
    $("#user_name").select2({
        placeholder: "Pilih",
        allowClear: true
    });

</script>
@endsection