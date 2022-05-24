    @extends('layouts.contact')

    @section('content')

    <div class="docp_top_menu">
        <div class="docp_logo">
            <img class="docp_logo_picture" src="../assets/images/logo.svg" alt="" />
        </div>
        <div class="dp_registration_buttons">
            <a class="dp_signup dp_btn">Apply</a>
        </div>
    </div>
    <div class="plp_learn_more">
        <h2 class="plp_learn_more_title">OneSignal Partner Ecosystem</h2>
        <p class="plp_learn_more_subtitle">Join our growing community today!</p>
        <a href="#" class="plp_apply_now_learn_more">Learn More</a>
    </div>

    <div class="plp_partner_login">
        <div class="plp_partner_login_description">
            <h3 class="plp_partner_login_title">Partner Login</h3>
            <p class="plp_partner_subtitle">
                If you already have an existing Partner Account, please login here to
                access your portal.
            </p>
        </div>
        <form action="" class="plp_partner_login_form">
            <h1 class="plp_greating">User Login</h1>

            <input id="plp_email" name="email" type="email" class="plp_partner_login_input" placeholder="Email" />

            <input id="plp_password" name="password" type="password" class="plp_partner_login_input" placeholder="Password" />

            <div class="stay_logged">
                <label class="plp_container container">Remember me
                    <input class="check" type="checkbox" />
                    <span class="checkmark"></span>
                </label>
            </div>
            <button class="login_button plp_login_button">Log in</button>
            <div class="plp_partner_login_forgot">
                <a href="#">Forgot Password?</a><a href="#">Forgot Username?</a>
            </div>
        </form>
    </div>
    <div class="plp_partner_integration">
        <div class="plp_partner_integration_img"><img src="" alt="" /></div>
        <div class="plp_partner_integration_header">
            <h3 class="plp_partner_integration_title">
                Partner Integrations Directory
            </h3>
            <p class="plp_partner_integration_subtitle">
                Learn more about our existing community of world-class Partners.
            </p>
            <a href="#" class="plp_apply_now_learn_more">Learn More</a>
        </div>
    </div>
    <div class="plp_apply_now">
        <h2 class="plp_apply_now_title">Yes, I Want To Apply!</h2>
        <p class="plp_apply_now_subtitle">
            Interested in joining the OneSignal Partner Ecosystem? Apply below using
            your email, and we'll be in touch!
        </p>
        <div class="plp_enter_email">
            <input type="text" class="plp_email_input" placeholder="Company E-mail Adress" />
            <a href="" class="plp_apply_button"></a>
        </div>
    </div>
    <footer class="dp_footer_background">
        <div class="plp_footer_content_block">
            <div class="plp_contact_us">
                <p>Contact Us</p>
                <p>2850 S Delaware St #201 San Mateo, CA 94403 Ukraine</p>
                <p>Copyright © 2022 Devonics. All Rights Reserved.</p>
                <p class="plp_contact_us_email">dv@devonics.com</p>
            </div>

            <ul class="plp_social_media_icons">
                <li>
                    <img src="../assets/images/social media/linkedin.svg" alt="" />
                </li>
                <li><img src="../assets/images/social media/fb.svg" alt="" /></li>

                <li>
                    <img src="../assets/images/social media/instagram.svg" alt="" />
                </li>

                <li>
                    <img src="../assets/images/social media/twitter.svg" alt="" />
                </li>
            </ul>
        </div>
    </footer>
    @endsection