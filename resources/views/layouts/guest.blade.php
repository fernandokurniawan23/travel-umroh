<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Haromain Travel')</title>
    <link rel="stylesheet" href="{{ asset('css/custom-login.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page" style="background: url('/images/bg-umrah.jpg') no-repeat center center; background-size: cover;">
<div class="login-box">
    <div class="login-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Umrah Travel Logo" width="120">
    </div>

    <!-- /.login-logo -->
    <div class="card" style="background-color: rgba(255,255,255,0.9); border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
        @yield('content')
    </div>
</div>
<!-- /.login-box -->

@vite('resources/js/app.js')
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
</body>
</html>
