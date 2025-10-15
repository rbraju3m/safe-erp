<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAFE | @yield('title', 'Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('backend.layout.css')
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini @yield('body-class')">
<div class="wrapper">

    @include('backend.layout.header')
    @include('backend.layout.nav')

    {{-- Page Content --}}
    @yield('body')

    @include('backend.layout.footer')
    @include('backend.layout.control_setting')

</div>

@include('backend.layout.js')
@stack('per_page_js')
</body>
</html>
