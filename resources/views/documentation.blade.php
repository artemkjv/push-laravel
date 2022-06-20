    @extends('layouts.contact')



    @section('content')
    <div class="docp_top_menu">
        <div class="docp_logo">
            <img class="docp_logo_picture" src="./assets/images/logo.svg" alt="" />
        </div>
        <div class="dp_registration_buttons">
            <a class="dp_signin dp_btn">Log in</a>
            <a class="dp_signup dp_btn">Sign up</a>
        </div>
        <div class="gamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="navigation">
        <ul class="nav_menu">
            <li>v8.0</li>
            <li>Guides</li>
            <li>Server REST API Reference</li>
        </ul>
        <ul class="nav_menu_tablet">
            <li>v8.0</li>
            <li>Guides</li>
            <li>
                <div id="docp_selector">
                    <p class="docp_selector_option">Docmentation</p>

                    <p class="docp_selector_option">Server REST API Reference</p>
                </div>
            </li>
        </ul>

        <input type="search" placeholder="Search" class="doc_search" />
    </div>
    <div class="content_block">
        <div class="onesignal_menu">
            <h2 class="onesignal_menu_menu_header">ONESIGNAL</h2>
            <ul class="onesignal_menu_menu_item">
                <li>Documentation</li>
                <li>Onboarding With OneSignal</li>
            </ul>
            <h2 class="onesignal_menu_menu_header">MOBILE PUSH</h2>
            <ul class="onesignal_menu_menu_item">
                <li>Mobile Push Quickstart</li>
                <li>SDK Reference</li>
                <li>Mobile Push Tutorials</li>
                <li>Mobile Push FAQ</li>
                <li>Mobile Troubleshooting</li>
            </ul>
            <h2 class="onesignal_menu_menu_header">WEB PUSH</h2>
            <ul class="onesignal_menu_menu_item">
                <li>Web Push Quickstart</li>
                <li>Web SDK Reference</li>
                <li>Web Push Tutorials</li>
                <li>Web Push FAQ</li>
                <li>Web Push Troubleshooting</li>
            </ul>
            <h2 class="onesignal_menu_menu_header">IN-APP MESSAGES</h2>
            <ul class="onesignal_menu_menu_item">
                <li>In-App Messages Quickstart</li>
                <li>In-App Message SDK Methods</li>
                <li>In-App Message Tutorials</li>
                <li>In-App Message FAQ</li>
            </ul>
            <h2 class="onesignal_menu_menu_header">EMAIL</h2>
            <ul class="onesignal_menu_menu_item">
                <li>Email Quickstart</li>
                <li>Email SDK Methods</li>
                <li>Email Tutorials</li>
                <li>Email FAQ</li>
            </ul>
            <h2 class="onesignal_menu_menu_header">SMS</h2>
            <ul class="onesignal_menu_menu_item">
                <li>SMS Quickstart</li>
                <li>SMS SDK Methods</li>
                <li>SMS Tutorials</li>
                <li>SMS FAQ</li>
            </ul>
            <h2 class="onesignal_menu_menu_header">PLATFORM</h2>
            <ul class="onesignal_menu_menu_item">
                <li>REST API Overview</li>
                <li>Users & Subscribers Guide</li>
                <li>Segments</li>
                <li>Data Tags</li>
                <li>Sending Push Messages</li>
                <li>Journeys</li>
                <li>Automated Messages</li>
                <li>Analytics Overview</li>
                <li>Retargeting Messages</li>
                <li>Integrations Overview</li>
            </ul>
            <h2 class="onesignal_menu_menu_header">ACCOUNT</h2>
            <ul class="onesignal_menu_menu_item">
                <li>Account Management</li>
                <li>Data and Security Questions</li>
                <li>Privacy Policy</li>
            </ul>
        </div>
        <div class="documentation_container">
            <div>
                <h1 class="bloks_header">Documentation</h1>
                <div class="description">
                    <p class="description_text">
                        Explore our guides and examples to integrate OneSignal.
                    </p>
                    <h3 class="description_highlited">
                        OneSignal is the fastest and most reliable service to send push
                        notifications, in-app messages, SMS, and emails.
                    </h3>
                    <p class="description_text">
                        In our documentation, you can discover resources and training to
                        implement OneSignal’s SDKs, learn how to leverage OneSignal’s
                        powerful dashboard and API, and find best practices for sending
                        messages.
                    </p>
                </div>
            </div>
            <div class="overview_container">
                <h1 class="bloks_header">Channel Overview</h1>
                <div class="overview_blocks">
                    <div class="overview_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Web Push</p>
                        <p class="summary">
                            Stay in front of your customers even after they leave your site.
                        </p>
                    </div>
                    <div class="overview_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Mobile Push</p>
                        <p class="summary">
                            Be the first message customers see when they pick up their
                            phones.
                        </p>
                    </div>
                    <div class="overview_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Email</p>
                        <p class="summary">
                            Craft beautiful, professional emails that convert and look great
                            on every device.
                        </p>
                    </div>
                    <div class="overview_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">In-App Messages</p>
                        <p class="summary">
                            Create interstitials, carousels, banners, and pop-ups that
                            convert.
                        </p>
                    </div>
                    <div class="overview_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">SMS</p>
                        <p class="summary">
                            Reach customers directly on their phone for higher engagement
                            and conversion.
                        </p>
                    </div>
                    <div class="overview_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Intregrations</p>
                        <p class="summary">Integrate OneSignal with third parties.</p>
                    </div>
                    <div class="overview_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">REST API</p>
                        <p class="summary">
                            Integrate OneSignal with your backend events, data, and more.
                        </p>
                    </div>
                </div>
            </div>
            <div class="sdk_guides_container">
                <h1 class="bloks_header">SDK Guides</h1>
                <h3 class="sdk_guides_container_subtitle">Native SDKs</h3>
                <div class="sdk_guides_blocks">
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Google Android Native</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">iOS Native</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Web Push</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Huawei Android Native</p>
                    </div>
                </div>

                <h3 class="sdk_guides_container_subtitle">Cross-Platform SDKs</h3>
                <div class="sdk_guides_blocks">
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Unity</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">React Native & Expo</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Cordova</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Ionic & Ionic Capacitor</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">PhoneGap</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Flutter</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Xamarin</p>
                    </div>
                    <div class="sdk_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Corona (Solar2D)</p>
                    </div>
                </div>
            </div>
            <div class="tutorials">
                <h1 class="bloks_header">OneSignal Video Tutorials</h1>
                <div class="tutorials_container">
                    <div class="tutorial_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Product Demo Video</p>
                        <p class="summary">
                            Learn more about the OneSignal Dashboard and key features of the
                            OneSignal Platform.
                        </p>
                    </div>
                    <div class="tutorial_block">
                        <div class="white_block"></div>
                        <p class="overview_block_name">Webinar Videos</p>
                        <p class="summary">
                            View webinars on OneSignal setup, integrations, and best
                            practices.
                        </p>
                    </div>
                </div>
            </div>
            <div class="questions_block">
                <h1 class="bloks_header">Questions?</h1>
                <p class="questions_block_subtitle">
                    If you have any questions, feel free to drop us a line!
                </p>
                <p class="questions_block_text">
                    Email us at<a href="#"> support@devonics.com</a>
                </p>
                <p class="questions_block_text">
                    <a href="#">Chat directly</a> with support.
                </p>
            </div>
        </div>
    </div>

    <div class="corner_image"></div>

    @endsection