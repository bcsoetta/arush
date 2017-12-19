@extends('layouts.app')

@section('pageName')
Home
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading main-color-bg">
    <h3 class="panel-title">App Overview</h3>
    </div>
    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <h2>Selamat Datang</h2>
        @if(auth()->user()->active == 0)
            <h1><span>Akun tidak active hubungi Admin atau Duktek</span></h1>
        @endif
    </div>
</div>

@endsection
