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
                <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                    <ion-icon name="person"></ion-icon>
                    Users
                </a>
                <a href="{{ route('admin.manager.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                    <ion-icon name="person"></ion-icon>
                    Managers
                </a>
                <a href="{{ route('admin.tariff.index') }}" class="list-group-item list-group-item-action bg-light mobile">
                    <ion-icon name="cash"></ion-icon>
                    Tariffs
                </a>
            </ul>
        </div>
    </div>
</nav>
