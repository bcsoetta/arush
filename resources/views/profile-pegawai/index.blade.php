@extends('layouts.app')

@section('pageName')
Profile Pegawai
@endsection

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading main-color-bg">
    <h3 class="panel-title">Profile</h3>
    </div>
    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        You are Profile
    </div>

</div>

@endsection
