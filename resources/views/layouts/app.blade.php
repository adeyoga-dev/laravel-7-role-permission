<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <!-- Microtip -->
    <link rel="stylesheet" href="//unpkg.com/microtip/microtip.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @stack('custom-style')
</head>
<body>
    <!-- Header -->
    @include('layouts.partials.header')
    <!-- Content -->
    <div class="container-fluid p-5">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}" defer></script>
    <!-- Jquery -->
    <script src="//code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="//kit.fontawesome.com/9d9ec351a4.js" crossorigin="anonymous"></script>
    <!-- Custom Scripts-->
    @stack('custom-script')
    <script src="{{asset('js/my.script.js')}}"></script>
    <script>
        let token = $("meta[name='csrf-token']").attr("content");
    </script>

</body>

</html>
