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
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/layout.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
<div id="notification-dialog"></div>
<div id="app">
    @include('components.header')

    <div class="d-flex" id="wrapper">
        @include('components.sidebar')
        <div id="page-content-wrapper">
            @include('components.messages')
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>
@yield('scripts')
<script type="text/javascript" src="https://www.gstatic.com/firebasejs/6.6.2/firebase-app.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/firebasejs/6.6.2/firebase-messaging.js"></script>
<script src="{{asset('assets/js/webpush.js?id=2')}}"></script>
<script>
    const cookieService = new Cookie()
    const notificationAccess = cookieService.getCookie('notification_access')
    if(notificationAccess === null && ("Notification" in window)){
        $('#notification-dialog').dialogBox({
            content: 'Stay in the loop with updates & <br>messaging tips to get more out of your CpaBro account.',
            title: "Notification request",
            hasClose: true,
            hasBtn: true,
            cancel: function (){
                cookieService.setCookie('notification_access', false, 10)
            },
            confirm: function (){
                DevonicsPush.initialize('f98c7427-5652-4747-b685-487e2d7518ae')
                cookieService.setCookie('notification_access', true)
            }
        })
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@livewireScripts
</body>
</html>
