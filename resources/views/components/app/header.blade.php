<header>
    <div class="navbar gap-5 gap-md-0">
        <div class="navbar-logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo">
        </div>
        <ul class="navbar-nav d-none d-xxl-flex">
            <li class="navbar-item">
                <a class="navbar-link" href="#">
                    Capabilities
                    <img src="{{ asset('assets/images/extend_menu.svg') }}" alt="">
                </a>

                <ul class="dropdown-menu">
                    <img class="dropdown-triangle" src="{{ asset('assets/images/menu_triangle.svg') }}" alt="">
                    <ul class="dropdown-submenu">
                        <li class="navbar-item">
                            <a href="#">Messaging channels </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Mobile push </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Web push </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">In-App </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Email </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">SMS </a>
                        </li>
                    </ul>
                    <ul class="dropdown-submenu">
                        <li class="navbar-item">
                            <a href="#">Features </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Journeys </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Personalization </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Segmentaion </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Analytics </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">A/B Testing </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">API </a>
                        </li>
                    </ul>
                    <div class="dropdown-divider"></div>
                    <ul class="dropdown-submenu">
                        <li class="navbar-item">
                            <a href="#">Industries</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Gaming </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">News/Media </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">eCommerce </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Mobile </a>
                        </li>
                    </ul>
                </ul>
            </li>
            <li class="navbar-item">
                <a class="navbar-link" href="#">Pricing </a>
            </li>
            <li class="navbar-item">
                <a class="navbar-link" href="#">Documentation</a>
            </li>
            <li class="navbar-item">
                <a class="navbar-link" href="#">
                    Resources
                    <img src="{{ asset('assets/images/extend_menu.svg') }}" alt="">
                </a>

                <ul class="dropdown-menu dropdown-menu-vertical">
                    <img class="dropdown-triangle" src="{{ asset('assets/images/menu_triangle.svg') }}" alt="">
                    <ul class="dropdown-submenu">
                        <li class="navbar-item">
                            <a href="#">Resources</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Resource Library</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Customer Case Studies</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">How-To Guides</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Demo Videos</a>
                        </li>
                    </ul>

                    <div class="dropdown-divider-horizontal"></div>
                    <ul class="dropdown-submenu">
                        <li class="navbar-item">
                            <a href="#">More</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Blog</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Notification Preview Tool</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Integrations</a>
                        </li>
                    </ul>
                </ul>
            </li>

            <li class="navbar-item">
                <a class="navbar-link" href="#">
                    Company
                    <img src="{{ asset('assets/images/extend_menu.svg') }}" alt="">
                </a>

                <ul class="dropdown-menu dropdown-menu-vertical">
                    <img class="dropdown-triangle" src="{{ asset('assets/images/menu_triangle.svg') }}" alt="">
                    <ul class="dropdown-submenu">
                        <li class="navbar-item">
                            <a href="#">Company</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">About Us</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Careers</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Newsroom</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Contact Sales</a>
                        </li>
                    </ul>

                    <div class="dropdown-divider-horizontal"></div>
                    <ul class="dropdown-submenu">
                        <li class="navbar-item">
                            <a href="#">Partner With Onesignal</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Partner Program </a>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Partner Login </a>
                        </li>
                    </ul>
                </ul>
            </li>
        </ul>
        <div class="d-flex" style="gap: 10px;">
            <a class="btn btn-outline input-rounded d-none d-xxl-block" href="{{ route('login') }}">Log in</a>
            <a class="btn btn-yellow input-rounded d-none d-xxl-block" href="{{ route('register') }}">Sign up</a>
            <div class="burger d-block d-xxl-none"><span></span><span></span><span></span></div>
        </div>
    </div>
</header>
