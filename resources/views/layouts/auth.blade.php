<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    @yield('head')

</head>
<body>
<div id="app">
    @include('components.auth.header')
    <main>
        @yield('content')
    </main>
</div>
@yield('scripts')
</body>
</html>
