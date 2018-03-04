<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/node-waves/waves.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('style/themes/all-themes.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/admin-style.css')}}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">

    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('favicon/android-icon-192x192.png')}}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <style>
        .sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle):before {
            top: 0;
        }

        a {
            color: #000;
        }

        a:hover {
            color: #000;
            text-decoration: none;
        }
    </style>
    @section('custom-style')
    @show
</head>
<body class="theme-teal">

<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="javascript:void(0);">@yield('title')</a>
        </div>
    </div>
</nav>

@section('sidebar')
@show

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>@yield('title')</h2>
        </div>
        @section('content')
        @show
    </div>
</section>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/material.js')}}"></script>
<script src="{{asset('js/master.js')}}"></script>

<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset("plugins/node-waves/waves.min.js")}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/admin-form-validation.js')}}"></script>

@section('custom-script')
@show
</body>
</html>
