<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="../../css/app.css" rel="stylesheet">

    @yield('head')

</head>

<body>
    <!-- <div id="app" @yield('app-config')> -->
    @include('components.push.menu')
    <main>
        @yield('content')
    </main>
    @include('components.app.footer')
    <!-- </div> -->
    <script src="../../assets/js/style.js"></script>
    @yield('scripts')
</body>

</html>