    @extends('layouts.contact')

    @section('content')
    <div class="docp_top_menu">
        <div class="ap_logo">
            <img class="docp_logo_picture" src="../assets/images/logo.svg" alt="" />
        </div>
        <div class="dp_registration_buttons">
            <a class="dp_signup dp_btn">Apply</a>
        </div>
    </div>
    <div class="ap_background">
        <div class="ap_partner_account_application">
            <h3 class="ap_partner_account_application_title">
                Partner Account Application
            </h3>
            <p class="ap_partner_account_application_subtitle">
                Please enter in your corporate email address. Generic email addresses
                will not be accepted.
            </p>
            <div class="ap_enter_email">
                <input type="text" class="ap_email_input" />
                <a href="#" class="ap_apply_button"></a>
            </div>
        </div>

        <div class="ap_footer_content_block">
            <div class="plp_contact_us">
                <p>Contact Us</p>
                <p>2850 S Delaware St #201 San Mateo, CA 94403 Ukraine</p>
                <p>Copyright © 2022 Devonics. All Rights Reserved.</p>
                <p class="plp_contact_us_email">dv@devonics.com</p>
            </div>

            <ul class="plp_social_media_icons">
                <li><a href='#'>
                        <img src="../assets/images/social-media/linkedin.svg" alt="" />
                    </a></li>
                <li><a href='#'><img src="../assets/images/social-media/fb.svg" alt="" /> </a></li>

                <li><a href='#'>
                        <img src="../assets/images/social-media/instagram.svg" alt="" />
                    </a></li>

                <li><a href='#'>
                        <img src="../assets/images/social-media/twitter.svg" alt="" />
                    </a></li>
            </ul>
        </div>
    </div>

    @endsection