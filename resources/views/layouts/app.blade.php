<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Arush - @yield('pageName')</title>
    <!-- Styles -->
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        thead>tr>th {
        text-align: center
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Arush
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @include('partial.navbar')
                </div>
            </div>
        </nav>
        <div class="container">
{{--             <ol class="breadcrumb">
<li><a href="#">Dasboarad</a></li>
<li><a href="#">Library</a></li>
<li class="active">Data</li>
</ol> --}}
</div>
<div class="container">
    @yield('content')
</div>
</div>
<!-- Scripts -->
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
@include('sweet::alert')
@yield('scripts')
</body>
</html>
