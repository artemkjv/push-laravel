<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Push.Devonics') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown desktop">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-light mobile mt-1">
                        <ion-icon name="home-outline"></ion-icon>
                        Dashboard
                    </a>
                    <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="settings-outline"></ion-icon>
                        Settings
                    </a>
                    <a href="{{ route('app.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="apps-outline"></ion-icon>
                        Applications
                    </a>
                    <a href="{{ route('segment.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="pie-chart-outline"></ion-icon>
                        Segments
                    </a>
                    <a href="{{ route('template.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="document-outline"></ion-icon>
                        Templates
                    </a>
                    <a href="{{ route('pushUser.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="people-outline"></ion-icon>
                        Push Users
                    </a>
                    <a href="{{ route('customPush.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="notifications-outline"></ion-icon>
                        Custom Pushes
                    </a>
                    <a href="{{ route('weeklyPush.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="notifications-outline"></ion-icon>
                        Weekly Pushes
                    </a>
                    <a href="{{ route('autoPush.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="notifications-outline"></ion-icon>
                        Auto Pushes
                    </a>
                    <a href="{{ route('sentPush.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                        <ion-icon name="stats-chart-outline"></ion-icon>
                        Delivery
                    </a>
                    @if(request()->user()->role === config('roles.admin') || request()->user()->role === config('roles.manager'))
                        <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                            <ion-icon name="person"></ion-icon>
                            Admin Panel
                        </a>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
