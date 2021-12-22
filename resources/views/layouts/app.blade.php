<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('components.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
    <script type="module" src="{{ asset('js/ionicons.esm.js') }}"></script>
    <script nomodule src="{{ asset('js/ionicons.js') }}"></script>
</body>
</html>
