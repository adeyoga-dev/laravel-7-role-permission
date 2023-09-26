<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <!-- Custom Styles -->
    @stack('custom-style')

</head>

<body>
    <!-- Header -->
    @include('layouts.partials.header')
    <!-- Content -->
    <div class="container-fluid mt-3">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}" defer></script>
    <!-- Custom Scripts-->
    @stack('custom-style')
</body>

</html>
